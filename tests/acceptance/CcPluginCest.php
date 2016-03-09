<?php


class CcPluginCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage("/archives/1");
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function testShowAkiyoshiShopList(AcceptanceTester $I)
    {
        $I->canSeeElement("#akiyoshi-list");
    }

    public function testShowKawaramachi(AcceptanceTester $I) {
        $I->canSee("河原町店", "#akiyoshi-list");
    }
}
