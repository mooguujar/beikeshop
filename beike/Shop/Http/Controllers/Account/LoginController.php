<?php
/**
 * LoginController.php
 *
 * @copyright  2022 opencart.cn - All Rights Reserved
 * @link       http://www.guangdawangluo.com
 * @author     TL <mengwb@opencart.cn>
 * @created    2022-06-22 20:22:54
 * @modified   2022-06-22 20:22:54
 */

namespace Beike\Shop\Http\Controllers\Account;

use Beike\Models\Customer;
use Beike\Shop\Http\Controllers\Controller;
use Beike\Shop\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use function auth;
use function back;
use function redirect;
use function view;

class LoginController extends Controller
{
    public function index()
    {
        return view('account/login');
    }

    public function store(LoginRequest $request)
    {
        $credentials = $request->only('login');

        if (!auth(Customer::AUTH_GUARD)->attempt($credentials['login'])) {
            throw new \Exception("账号密码错误！");
        }

        json_success("登录成功!");
    }
}