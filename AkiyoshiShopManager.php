<?php

/**
 * Created by PhpStorm.
 * User: ippeisumida
 * Date: 2016/03/08
 * Time: 22:30
 */
class AkiyoshiShopManager {

	private $url = "https://raw.githubusercontent.com/Ippey/AkiyoshiShopList/master/shop.csv";

	/**
	 * WPアクション登録
	 */
	public function register() {
		add_shortcode( "akiyoshi", array( $this, "showShopList" ) );
	}

	/**
	 * 都道府県でリスト取得
	 *
	 * @param $prefecture
	 *
	 * @return array
	 */
	private function getListByPrefecture( $prefecture ) {
		$all  = $this->getList();
		$rows = array();
		foreach ( $all as $row ) {
			if ( $row["prefecture"] === $prefecture ) {
				$rows[] = $row;
			}
		}

		return $rows;

	}


	/**
	 * 全リスト取得
	 *
	 * @return array
	 */
	private function getList() {
		$handle = fopen( $this->url, "r" );
		$keys   = array();
		$rows   = array();
		while ( ( $cols = fgetcsv( $handle ) ) !== false ) {
			if ( count( $keys ) == 0 ) {
				foreach ( $cols as $col ) {
					$keys[] = $col;
				}
				continue;
			}

			$row = array();
			for ( $i = 0; $i < count( $keys ); $i ++ ) {
				$key         = $keys[ $i ];
				$val         = $cols[ $i ];
				$row[ $key ] = $val;
			}
			$rows[] = $row;
		}

		return $rows;
	}

	/**
	 * 店舗リストをテーブル表示する
	 *
	 * @param $attr
	 *
	 * @return string
	 */
	public function showShopList( $attr ) {
		$rows = $this->getListByPrefecture( $attr[0] );
		$html = "<table id=\"akiyoshi-list\">";
		$keys = array( "name", "address", "tel" );
		foreach ( $rows as $row ) {
			$html .= "<tr>";
			foreach ( $keys as $key ) {
				$val = htmlspecialchars($row[$key]);
				$html .= "<td>{$val}</td>";
			}
			$html .= "</tr>";
		}
		$html .= "</table>";

		return $html;
	}

}