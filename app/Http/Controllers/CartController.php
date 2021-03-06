<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\PizzaAddon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the request
        $validated = $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1',
        ]);

        // create an instance of the product
        $product = (new Product())->findOrFail($validated['product_id']);

        // check if a cart exists for this authenticated user
        $cart = Cart::where('user_id', auth()->id())
            ->where('is_paid', false)
            ->first();

        // if the authenticated user has no cart, create one
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => auth()->id(),
                'total' => 0,
                'is_paid' => false,
            ]);
        }

        // check if the product is already in the cart and remove
        $cart->products()->detach($product->id);

        // calculate product total
        $product_total = $product->price * $validated['quantity'];

        // check if there are any addons and add them to the product total
        if ($request->pizza_addons) {
            foreach ($request->pizza_addons as $addon) {
                $product_total += (new PizzaAddon())->findOrFail($addon)->value * $validated['quantity'];
            }
        }

        // add the product to the cart
        $cart->products()->attach([
            $product->id => [
                'quantity' => $validated['quantity'],
                'price' => $product->price,
                'total' => $product_total,
                'addons' => $request->pizza_addons ? json_encode($request->pizza_addons) : null,
            ]
        ]);

        // loop through the products in the cart and calculate the total
        $cart->total = 0;
        foreach ($cart->products as $product) {
            $cart->total += $product->pivot->total;
        }
        $cart->save();

        // put the cart ID to the session so that it can be accessible in the view
        session()->put('cart_id', $cart->id);

        return redirect()->route('cart.show', $cart->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Cart $cart)
    {
        // check if the cart is paid and redirect to the home page
        if ($cart->is_paid) {
            return redirect()->route('home');
        }

        // check if the cart belongs to the authenticated user
        if ($cart->user_id !== $request->user()->id) {
            abort(403, 'Sorry, this cart does not belong to you.');
        }

        return view('cart.show', compact('cart'));
    }

    /**
     * Checkout
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request, Cart $cart)
    {
        // check if the cart is paid and redirect to the home page
        if ($cart->is_paid) {
            return redirect()->route('home');
        }

        // check if the cart belongs to the authenticated user
        if ($cart->user_id !== $request->user()->id) {
            abort(403, 'Sorry, this cart does not belong to you.');
        }

        // create an order for the cart
        $order = Order::where('cart_id', $cart->id)
            ->where('user_id', $request->user()->id)
            ->first();

        // if the order does not exist, create one
        if (!$order) {
            $order = Order::create([
                'cart_id' => $cart->id,
                'user_id' => $request->user()->id,
                'status' => 'pending',
                'payment_status' => 'pending',
                'method' => 'delivery',
                'total' => $cart->total,
            ]);
        }

        // create an instance of the promotion and check if this promotion is applicable to the cart
        $promotion = (new \App\Models\Promotion())->find($order->promotion_id);

        if ($promotion) {
            // check for the promotion type
            if ($promotion->type == 'number_of_items_validation') {

                // count all the products in the cart
                $count = 0;
                foreach ($cart->products as $product) {
                    $count += $product->pivot->quantity;
                }
                // BOGOF
                // Medium & Large
                // check if the promotion has a value and that is equal to the number of items in the cart
                if ($promotion->value == $count &&  $promotion->code == 'BOGOF' && $promotion->pizza_model_id = 3 && $promotion->pizza_model_id = 6 
                && $promotion->pizza_model_id = 9 && $promotion->pizza_model_id = 12 && $promotion->pizza_model_id = 2 && $promotion->pizza_model_id = 5 
                && $promotion->pizza_model_id = 8 && $promotion->pizza_model_id = 11) {

                    // attach the promotion ID to the order
                    $order->promotion_id = $promotion->id;
    
                    // check for the promotion price type and calculate the total
                    if ($promotion->price_type == 'fixed') {
                        $order->total = $cart->total - $promotion->price_value;
                        $order->discount = $cart->total - $order->total;
                    } else if ($promotion->price_type == 'percentage') {
    
                        $order->total = ($cart->total - ($cart->total * $promotion->price_value / 100)) / 2;
                        $order->discount = $cart->total - $order->total;
                    }
    
                    // save the order
                    $order->save();
    
                    session()->flash('promotion_success', $promotion->name . ' applied successfully.');
                }
                // Three for Two
                // Medium 
                // check if the promotion has a value and that is equal to the number of items in the cart
                elseif ($promotion->value == $count &&  $promotion->code == '3FOR2' && $product->summary == 'Medium' 
                && $promotion->pizza_model_id = 2 && $promotion->pizza_model_id = 5 && $promotion->pizza_model_id = 8 && $promotion->pizza_model_id = 11) {
    
                    // attach the promotion ID to the order
                    $order->promotion_id = $promotion->id;
    
                    // check for the promotion price type and calculate the total
                    if ($promotion->price_type == 'fixed' && $product->summary == 'Medium') {
                        $order->total = $cart->total - $promotion->price_value;
                        $order->discount = $cart->total - $order->total;
                    } else if ($promotion->price_type == 'percentage' && $product->summary == 'Medium') {
    
                        $order->total = $cart->total - ($cart->total * $promotion->price_value / 100);
                        $order->discount = $cart->total - $order->total;
                    }
    
                    // save the order
                    $order->save();
    
                    session()->flash('promotion_success', $promotion->name . ' applied successfully.');
                }
                // Family Feast
                // Medium 
                // check if the promotion has a value and that is equal to the number of items in the cart
                elseif ($promotion->value == $count && $promotion->code == 'B21000OFF' && $product->summary == 'Medium' && $promotion->pizza_model_id = 2 
                && $promotion->pizza_model_id = 5 && $promotion->pizza_model_id = 8 && $promotion->pizza_model_id = 11) {
    
                    // attach the promotion ID to the order
                    $order->promotion_id = $promotion->id;
    
                    // check for the promotion price type and calculate the total
                    if ($promotion->price_type == 'fixed' && $product->summary == 'Medium') {
                        $order->total = $promotion->price_value;
                        $order->discount = $promotion->price_value;
                    } else if ($promotion->price_type == 'percentage' && $product->summary == 'Medium') {
    
                        $order->total = $cart->total - ($cart->total * $promotion->price_value / 100);
                        $order->discount = $cart->total - $order->total;
                    }
    
                    // save the order
                    $order->save();
    
                    session()->flash('promotion_success', $promotion->name . ' applied successfully.');
                }
                // Two Large 
                // Large 
                // check if the promotion has a value and that is equal to the number of items in the cart
                elseif ($promotion->value == $count && $promotion->code == '2LARGE' && $product->summary == 'Large' 
                &&  $promotion->pizza_model_id = 3 && $promotion->pizza_model_id = 6 && $promotion->pizza_model_id = 9 && $promotion->pizza_model_id = 12) {
    
                    // attach the promotion ID to the order
                    $order->promotion_id = $promotion->id;
    
                    // check for the promotion price type and calculate the total
                    if ($promotion->price_type == 'fixed' && $product->summary == 'Large') {
                        $order->total = $promotion->price_value;
                        $order->discount = $promotion->price_value;
                    } else if ($promotion->price_type == 'percentage' && $product->summary == 'Large') {
    
                        $order->total = $cart->total - ($cart->total * $promotion->price_value / 100);
                        $order->discount = $cart->total - $order->total;
                    }
    
                    // save the order
                    $order->save();
    
                    session()->flash('promotion_success', $promotion->name . ' applied successfully.');
                }
                // Two Medium
                // Large 
                // check if the promotion has a value and that is equal to the number of items in the cart
                elseif ($promotion->value == $count && $promotion->code == '2MEDIUM' && $product->summary == 'Medium'  
                && $promotion->pizza_model_id = 2 && $promotion->pizza_model_id = 5 && $promotion->pizza_model_id = 8 && $promotion->pizza_model_id = 11) {
    
                    // attach the promotion ID to the order
                    $order->promotion_id = $promotion->id;
    
                    // check for the promotion price type and calculate the total
                    if ($promotion->price_type == 'fixed' && $product->summary == 'Medium') {
                        $order->total = $promotion->price_value;
                        $order->discount = $promotion->price_value;
                    } else if ($promotion->price_type == 'percentage' && $product->summary == 'Medium') {
    
                        $order->total = $cart->total - ($cart->total * $promotion->price_value / 100);
                        $order->discount = $cart->total - $order->total;
                    }
    
                    // save the order
                    $order->save();
    
                    session()->flash('promotion_success', $promotion->name . ' applied successfully.');
                }
                // Two Small
                // Large 
                // check if the promotion has a value and that is equal to the number of items in the cart
                elseif ($promotion->value == $count && $promotion->code == '2SMALL' && $product->summary == 'Small' 
                && $promotion->pizza_model_id = 1 && $promotion->pizza_model_id = 4 && $promotion->pizza_model_id = 7 && $promotion->pizza_model_id = 10) {
    
                    // attach the promotion ID to the order
                    $order->promotion_id = $promotion->id;
    
                    // check for the promotion price type and calculate the total
                    if ($promotion->price_type == 'fixed' && $product->summary == 'Small') {
                        $order->total = $promotion->price_value;
                        $order->discount = $promotion->price_value;
                    } else if ($promotion->price_type == 'percentage' && $product->summary == 'Small') {
    
                        $order->total = $cart->total - ($cart->total * $promotion->price_value / 100);
                        $order->discount = $cart->total - $order->total;
                    }
    
                    // save the order
                    $order->save();
    
                    session()->flash('promotion_success', $promotion->name . ' applied successfully.');

                } else {
    
                    $order->total = $cart->total;
                    $order->discount = 0;
                    $order->promotion_id = null;
    
                    $order->save();
    
                    session()->flash('error', 'Sorry, ' . $promotion->name . ' promotion is not applicable to your cart.');
                }
            }
        }

        // get all active promotions in the system
        $promotions = \App\Models\Promotion::where('is_active', true)->get();

        return view('cart.checkout', [
            'cart' => $cart,
            'user' => $request->user(),
            'promotions' => $promotions,
            'order' => $order
        ]);
    }

    public function updateOrder(Request $request, Cart $cart, Order $order)
    {
        // check if the request has a promotion id
        $request->validate([
            'promotion_id' => 'required|numeric|exists:promotions,id',
        ]);

        // create an instance of the promotion and check if this promotion is applicable to the cart
        $promotion = (new \App\Models\Promotion())->findOrFail($request->promotion_id);

        // check for the promotion type
        if ($promotion->type == 'number_of_items_validation') {

            // count all the products in the cart
            $count = 0;
            
            foreach ($cart->products as $product) {
                $count += $product->pivot->quantity;
            }
            

            // BOGOF
                // Medium & Large
                // check if the promotion has a value and that is equal to the number of items in the cart
                if ($promotion->value == $count &&  $promotion->code == 'BOGOF' && $promotion->pizza_model_id = 3 && $promotion->pizza_model_id = 6 
                && $promotion->pizza_model_id = 9 && $promotion->pizza_model_id = 12 && $promotion->pizza_model_id = 2 && $promotion->pizza_model_id = 5 
                && $promotion->pizza_model_id = 8 && $promotion->pizza_model_id = 11) {

                    // attach the promotion ID to the order
                    $order->promotion_id = $promotion->id;
    
                    // check for the promotion price type and calculate the total
                    if ($promotion->price_type == 'fixed') {
                        $order->total = $cart->total - $promotion->price_value;
                        $order->discount = $cart->total - $order->total;
                    } else if ($promotion->price_type == 'percentage') {
    
                        $order->total = ($cart->total - ($cart->total * $promotion->price_value / 100)) / 2;
                        $order->discount = $cart->total - $order->total;
                    }
    
                    // save the order
                    $order->save();
    
                    session()->flash('promotion_success', $promotion->name . ' applied successfully.');
                }
                // Three for Two
                // Medium 
                // check if the promotion has a value and that is equal to the number of items in the cart
                elseif ($promotion->value == $count &&  $promotion->code == '3FOR2' && $product->summary == 'Medium' 
                && $promotion->pizza_model_id = 2 && $promotion->pizza_model_id = 5 && $promotion->pizza_model_id = 8 && $promotion->pizza_model_id = 11) {
    
                    // attach the promotion ID to the order
                    $order->promotion_id = $promotion->id;
    
                    // check for the promotion price type and calculate the total
                    if ($promotion->price_type == 'fixed' && $product->summary == 'Medium') {
                        $order->total = $cart->total - $promotion->price_value;
                        $order->discount = $cart->total - $order->total;
                    } else if ($promotion->price_type == 'percentage' && $product->summary == 'Medium') {
    
                        $order->total = $cart->total - ($cart->total * $promotion->price_value / 100);
                        $order->discount = $cart->total - $order->total;
                    }
    
                    // save the order
                    $order->save();
    
                    session()->flash('promotion_success', $promotion->name . ' applied successfully.');
                }
                // Family Feast
                // Medium 
                // check if the promotion has a value and that is equal to the number of items in the cart
                elseif ($promotion->value == $count && $promotion->code == 'B21000OFF' && $product->summary == 'Medium' && $promotion->pizza_model_id = 2 
                && $promotion->pizza_model_id = 5 && $promotion->pizza_model_id = 8 && $promotion->pizza_model_id = 11) {
    
                    // attach the promotion ID to the order
                    $order->promotion_id = $promotion->id;
    
                    // check for the promotion price type and calculate the total
                    if ($promotion->price_type == 'fixed' && $product->summary == 'Medium') {
                        $order->total = $promotion->price_value;
                        $order->discount = $promotion->price_value;
                    } else if ($promotion->price_type == 'percentage' && $product->summary == 'Medium') {
    
                        $order->total = $cart->total - ($cart->total * $promotion->price_value / 100);
                        $order->discount = $cart->total - $order->total;
                    }
    
                    // save the order
                    $order->save();
    
                    session()->flash('promotion_success', $promotion->name . ' applied successfully.');
                }
                // Two Large 
                // Large 
                // check if the promotion has a value and that is equal to the number of items in the cart
                elseif ($promotion->value == $count && $promotion->code == '2LARGE' && $product->summary == 'Large' 
                &&  $promotion->pizza_model_id = 3 && $promotion->pizza_model_id = 6 && $promotion->pizza_model_id = 9 && $promotion->pizza_model_id = 12) {
    
                    // attach the promotion ID to the order
                    $order->promotion_id = $promotion->id;
    
                    // check for the promotion price type and calculate the total
                    if ($promotion->price_type == 'fixed' && $product->summary == 'Large') {
                        $order->total = $promotion->price_value;
                        $order->discount = $promotion->price_value;
                    } else if ($promotion->price_type == 'percentage' && $product->summary == 'Large') {
    
                        $order->total = $cart->total - ($cart->total * $promotion->price_value / 100);
                        $order->discount = $cart->total - $order->total;
                    }
    
                    // save the order
                    $order->save();
    
                    session()->flash('promotion_success', $promotion->name . ' applied successfully.');
                }
                // Two Medium
                // Large 
                // check if the promotion has a value and that is equal to the number of items in the cart
                elseif ($promotion->value == $count && $promotion->code == '2MEDIUM' && $product->summary == 'Medium'  
                && $promotion->pizza_model_id = 2 && $promotion->pizza_model_id = 5 && $promotion->pizza_model_id = 8 && $promotion->pizza_model_id = 11) {
    
                    // attach the promotion ID to the order
                    $order->promotion_id = $promotion->id;
    
                    // check for the promotion price type and calculate the total
                    if ($promotion->price_type == 'fixed' && $product->summary == 'Medium') {
                        $order->total = $promotion->price_value;
                        $order->discount = $promotion->price_value;
                    } else if ($promotion->price_type == 'percentage' && $product->summary == 'Medium') {
    
                        $order->total = $cart->total - ($cart->total * $promotion->price_value / 100);
                        $order->discount = $cart->total - $order->total;
                    }
    
                    // save the order
                    $order->save();
    
                    session()->flash('promotion_success', $promotion->name . ' applied successfully.');
                }
                // Two Small
                // Large 
                // check if the promotion has a value and that is equal to the number of items in the cart
                elseif ($promotion->value == $count && $promotion->code == '2SMALL' && $product->summary == 'Small' 
                && $promotion->pizza_model_id = 1 && $promotion->pizza_model_id = 4 && $promotion->pizza_model_id = 7 && $promotion->pizza_model_id = 10) {
    
                    // attach the promotion ID to the order
                    $order->promotion_id = $promotion->id;
    
                    // check for the promotion price type and calculate the total
                    if ($promotion->price_type == 'fixed' && $product->summary == 'Small') {
                        $order->total = $promotion->price_value;
                        $order->discount = $promotion->price_value;
                    } else if ($promotion->price_type == 'percentage' && $product->summary == 'Small') {
    
                        $order->total = $cart->total - ($cart->total * $promotion->price_value / 100);
                        $order->discount = $cart->total - $order->total;
                    }
    
                    // save the order
                    $order->save();
    
                    session()->flash('promotion_success', $promotion->name . ' applied successfully.');

                } else {
    
                    $order->total = $cart->total;
                    $order->discount = 0;
                    $order->promotion_id = null;
    
                    $order->save();
    
                    session()->flash('error', 'Sorry, ' . $promotion->name . ' promotion is not applicable to your cart.');
                }
        }

        // redirect to the checkout page
        return redirect()->route('cart.checkout', $cart->id);
    }

    /**
     * Complete payment and checkout
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function completeCheckout(Request $request, Cart $cart, Order $order)
    {

        // validate the request
        $validated = $request->validate([
            "method" => "nullable",
            "title" => "required",
            "first_name" => "required|string|max:255",
            "last_name" => "required|string|max:255",
            "gender" => "required",
            "birthday" => "nullable",
            "address_1" => "required|string",
            "address_2" => "nullable",
            "city" => "required|string|max:255",
            "postcode" => "required|string|max:255",
            "county" => "required|string|max:255",
            "phone" => "nullable",
            "mobile" => "nullable|string|max:255"
        ]);

        // get the user from the request
        $user = $request->user();

        // update the user with the validated data
        $user->update($validated);

        // update the order with the validated data
        $order->update([
            'status' => 'processing',
            'payment_status' => 'paid',
            'method'=> 'collection','delivery',
            'address_1' => $validated['address_1'],
            'address_2' => $validated['address_2'],
            'city' => $validated['city'],
            'postcode' => $validated['postcode'],
            'county' => $validated['county'],
            'phone' => $validated['phone'],
            'mobile' => $validated['mobile'],
        ]);

        // update the cart and set the payment status to true
        $cart->update([
            'is_paid' => true
        ]);

        // remove the cart id from the session
        session()->forget('cart_id');

        return view('cart.thank-you', [
            'cart' => $cart
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCartRequest  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        // validate the request
        $validated = $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1',
        ]);

        // create an instance of the product
        $product = (new Product())->findOrFail($validated['product_id']);

        // check if the product is already in the cart and remove
        $cart->products()->detach($product->id);

        // add the product to the cart
        $cart->products()->attach([
            $product->id => [
                'quantity' => $validated['quantity'],
                'price' => $product->price,
                'total' => $product->price * $validated['quantity'],
                
            ]
        ]);

        // loop through the products in the cart and calculate the total
        $cart->total = 0;
        foreach ($cart->products as $product) {
            $cart->total += $product->pivot->total;
        }
        $cart->save();

        return redirect()->route('cart.show', $cart->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Cart $cart)
    {
        $cart->products()->detach($request->product_id);

        // loop through the products in the cart and calculate the total
        $cart->total = 0;
        foreach ($cart->products as $product) {
            $cart->total += $product->pivot->total;
        }

        $cart->save();

        return redirect()->route('cart.show', $cart->id);
    }
}