<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class StoreController extends Controller
{
        public function index(Request $request)
        {
            $stores = User::where('roles', 'seller')->get();
            return response()->json([
                'status' => 'success',
                'message' => 'List Store',
                'data' => $stores,
            ]);
        }

        public function productByStore(Request $request, $id)
        {
            $products = Product::where('seller_id', $id)->get();
            return response()->json([
                'status' => 'success',
                'message' => 'List Product by Store',
                'data' => $products,
            ]);
        }

        public function livestreaming(Request $request) {
            $stores = User::where('roles', 'seller')->where('is_livestreaming', true)->get();

            return response()->json([
                'status' => 'success',
                'message' => 'List Store Livestreaming',
                'data' => $stores,
            ], 200);
        }

        // set is livestreaming
        public function setLiveStreaming(Request $request) {
            $id = $request->user()->id;
            $store = User::find($id);
            $isActive = $request->is_active;
            $store->update([
                'is_livestreaming' => $isActive,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Store is livestreaming',
            ]);
        }
}
