<?php
/**
 * WishlistController.php
 *
 * @copyright  2022 opencart.cn - All Rights Reserved
 * @link       http://www.guangdawangluo.com
 * @author     TL <mengwb@opencart.cn>
 * @created    2022-07-14 20:47:04
 * @modified   2022-07-14 20:47:04
 */

namespace Beike\Shop\Http\Controllers\Account;

use Illuminate\Http\Request;
use Beike\Repositories\CustomerRepo;
use Beike\Shop\Http\Controllers\Controller;
use Beike\Shop\Http\Resources\Account\WishlistDetail;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = CustomerRepo::wishlists(current_customer());
        $data = [
            'wishlist' => WishlistDetail::collection($wishlists)->jsonSerialize(),
        ];

        return view('account/wishlist', $data);
    }

    public function add(Request $request): array
    {
        $productId = $request->get('product_id');
        $wishlist = CustomerRepo::addToWishlist(current_customer(), $productId);

        return json_success(trans('shop/wishlist.add_wishlist_success'), $wishlist);
    }

    public function remove(Request $request): array
    {
        $id = $request->id;
        CustomerRepo::removeFromWishlist(current_customer(), $id);

        return json_success(trans('shop/wishlist.remove_wishlist_success'));
    }

}
