<?php
/**
 * 没有依赖注入
 */
//// 文件缓存类
//class FileCache
//{
//    public function get($key) {
//        echo "取出缓存\n";
//    }
//    public function put($key, $value) {
//        echo "存入缓存\n";
//    }
//}
//
//// 用户注册
//class User
//{
//    private $cache;
//
//    // User类想使用FileCache类，需要在User类里面实例化FileCache对象
//    public function __construct()
//    {
//        $this->cache = new FileCache();
//    }
//
//    //注册逻辑
//    public function register($phone)
//    {
//        //注册成功后，把信息写入缓存
//        $this->cache->put('phone',$phone);
//
//        $this->cache->get($phone);
//    }
//}
////使用
//$use = new User();
//$use->register('188-4561-9852');

/**
 * 依赖注入
 */
// 文件缓存类
class FileCache
{
    public function get($key) {
        echo "取出缓存\n";
    }
    public function put($key, $value) {
        echo "存入缓存\n";
    }
}

// 用户注册
class User
{
    private $cache;

    // User类想使用FileCache类，需要在User类里面实例化FileCache对象
    // 通过构造函数接收依赖关系
    public function __construct(FileCache $cache)
    {
        $this->cache = $cache;
    }

    //注册逻辑
    public function register($phone)
    {
        //注册成功后，把信息写入缓存
        $this->cache->put('phone',$phone);

        $this->cache->get($phone);
    }
}
// 把依赖关系注入
$use = new User(new FileCache());
$use->register('188-4561-9852');