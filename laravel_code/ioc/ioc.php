<?php
/**
 * https://blog.csdn.net/maclechan/article/details/103248382?spm=1001.2014.3001.5501
 *
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
//    // 通过构造函数接收依赖关系
//    public function __construct(FileCache $cache)
//    {
//        $this->cache = $cache;
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
//// 把依赖关系注入
//$use = new User(new FileCache());
//$use->register('188-4561-9852');



//缓存接口
interface Cache
{
    public function get($key);
    public function put($key, $value);
}
//文件缓存类
class FileCache implements Cache
{
    public function get($key) {
        echo "文件缓存:取出缓存\n";
    }

    public function put($key, $value) {
        echo "文件缓存:存入缓存\n";
    }
}
//redis缓存类
class RedisCache implements Cache
{
    public function get($key) {
        echo "redis缓存:取出缓存\n";
    }

    public function put($key, $value) {
        echo "redis缓存:存入缓存\n";
    }
}

//memcache缓存类
class MemCache implements Cache
{
    public function get($key) {
        echo "memcache缓存:取出缓存\n";
    }

    public function put($key, $value) {
        echo "memcache缓存:存入缓存\n";
    }
}

//用户注册
class User
{
    private $cache;

    //参数必须是cache接口的一个实例
    public function __construct(Cache $cache)
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

//使用
//$use = new User(new RedisCache());
//$use->register('188-4561-9852');


/**
 * 容器类，将接口与实现绑定
 */
class Container
{
    // 保存与接口绑定的闭包，
    // 闭包必须能够返回接口的实例。
    protected $bindings = [];

    /**
     * 为某个接口绑定一个实现两种方式：
     * 1. 绑定接口的实现的类名
     * 2. 绑定一个闭包，这个闭包应该返回接口的实例（闭包能够在实例化前后进行额外的操作）
     * 两种方式的实例化操作都是调用 build() 方法完成
     * @param $abstract
     * @param null $concrete
     */
    public function bind($abstract, $concrete = null)
    {
        /**
         * 则构建一个闭包
         * 1.如果参数是绑定接口和实现类 如传进来(Cache, FileCache) 则 bindings[Cache] = new FileCache
         *
         * 2.如果参数是绑定依赖和实现 如传进来(User,User) 则 bindings[User] = new User(Cache) 注意：虽然这里看上去传的是接口Cache，
         *   但实际上在第1步的时候注册了一个具体FileCache实现，即 new User(new FileCache)
         */

        // 判断是不是闭包函数
        if(!$concrete instanceof Closure) {
            var_dump($concrete);
            // 调用闭包时，传入的参数是容器本身，即 $this
            $concrete = function ($c) use ($concrete) {
//                var_dump($c);
                return $c->build($concrete);
            };
        }

        $this->bindings[$abstract] = $concrete;
        // bindings[Cache] = new FileCache
        // bindings[user]  = new User

//        var_dump($this->bindings);
    }

    /**
     * 生成指定接口的实例
     * @param $abstract
     * @return mixed
     */
    public function make($abstract)
    {
        // 闭包赋值变量
        $concrete = $this->bindings[$abstract];
        //print_r($concrete($this)->get('dd'));
        //print_r($concrete($this));
        // 运行闭包，即可取得一个实例
        return $concrete($this);
    }

    /**
     * @param $concrete
     * @return mixed|object
     * @throws ReflectionException
     */
    public function build($concrete)
    {
        // 初始化要反射的具体对象（比如FileCache）
        $reflector = new ReflectionClass($concrete);
//        var_dump($reflector);

        // 检查类是否可实例化
        if (! $reflector->isInstantiable()) {
            // 接口无法实例化
            echo $message = "[$concrete] 无法实例化";
        }

        // 取得构造函数的反射
        $constructor = $reflector->getConstructor();

        // 检查是否有构造函数 （注意，因为我们这里的依赖关系是通过构造函数绑定的）
        //如果依赖关系是通过其他方式(如setter)绑定的，通过反射API如getMethod来拿到依赖关系
        //显然，绑定接口和实现类时，这里就直接实例化实现类(如 FileCache Object ( ))
        if (is_null($constructor)) {
            // 如果没有，就说明没有依赖，直接实例化
            return new $concrete;
        }

        // 取得包含每个参数的反射的数组
        $parameters = $constructor->getParameters();

        // 返回一个真正的参数列表，那些被类型提示的参数已经被注入相应的实例
        $realParameters = [];
        foreach($parameters as $parameter) {
            // 如果一个参数被类型提示为类 Cache，
            // 则这个方法将返回类 Cache 的反射
            $dependency = $parameter->getClass();
            if(is_null($dependency)) {
                $realParameters[] = NULL;
            } else {
                $realParameters[] = $this->make($dependency->name);
            }
        }

        return $reflector->newInstanceArgs($realParameters);
    }
}

/**
 * 客户端使用
 */
$ioc = new Container;
//先绑定接口和某个实现类
$ioc->bind('Cache','RedisCache');
//绑定使用类
$ioc->bind('user','User');
$user = $ioc->make("user");
$user->register('iy');