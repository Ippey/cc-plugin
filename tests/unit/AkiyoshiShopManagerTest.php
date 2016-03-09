<?php


class AkiyoshiShopManagerTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $manager;

    protected function _before()
    {
        $this->manager = new AkiyoshiShopManager();
    }

    protected function _after()
    {
    }

    // tests
    /**
     * getListのテスト
     */
    public function testGetList()
    {
        $method = $this->getPrivateMethod($this->manager, "getList");
        $list = $method->invoke($this->manager);
        $this->assertTrue(is_array($list));

    }

    /**
     * getListByPrefectureのテスト
     */
    public function testGetListByPrefecture() {
        $pref = "京都府";
        $method = $this->getPrivateMethod($this->manager, "getListByPrefecture");
        $list = $method->invoke($this->manager, array($pref));
        foreach ($list as $row) {
            $this->assertEquals($pref, $row["prefecture"]);
        }
    }

    /**
     * プライベートメソッドを呼ぶためのReflectionMethodを返す
     *
     * @param $obj
     * @param $name
     *
     * @return ReflectionMethod
     */
    private function getPrivateMethod($obj, $name) {
        $method = new ReflectionMethod($obj, $name);
        $method->setAccessible(true);
        return $method;
    }
}