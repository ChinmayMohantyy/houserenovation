<?php

namespace App\Http\Controllers\Housecaptain;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\InventoryOrder;
use App\Models\InventoryOrderItem;
use App\Models\Notification;
use App\Models\HouseRepairRequest;
use App\Models\InventoryOrderRentableItem;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Throwable;

class WorkController extends Controller
{
    public function addRequiredInventoryForWork(Request $request,$id){

        $validate = Validator::make($request->all(),[
        ]);
        // if($validate->fails()){
        //     return response()->json(['status'=>false,'validation_errors'=>$validate->errors()]);
        // }
        try{
            DB::beginTransaction();

            // $inventory_order = new InventoryOrder();
            // $inventory_order->house_repair_request_id = $request->house_repair_request_id;
            // $inventory_order->house_captain_id = $request->house_captain_id;
            // $inventory_order->warehouse_id = $request->warehouse_id;
            // $inventory_order->save();

            // $inventories = $request->inventories;

            // $new_inventories = [];
            // foreach($inventories as $i => $inventory){
            //     $inv = json_decode($inventory);
            //     $inv->required_quantity = $request->required_quantity[$i];
            //     //dump($inv);
            //     array_push($new_inventories,$inv);
            // } 

            // return  $new_inventories;
            // dd($inventories);
            // foreach($inventories as $inv){
            //     // return  $inv->required_quantity;
            //     $inv = json_decode($inv);
            //     $inventory = Inventory::find($inv->inventory_id);
            //     if($inventory->inventory_type == 's'){
            //         $inventory_order_item = new InventoryOrderItem();
            //         $inventory_order_item->inventory_order_id = $inventory_order->id;
            //         $inventory_order_item->inventory_id = $inventory->id;
            //         $inventory_order_item->required_quantity = $inv->required_quantity;
            //         $inventory_order_item->unit_price =  $inventory->unit_price;
            //         $inventory_order_item->total_price = $inventory->unit_price * $inv->required_quantity;
            //         $inventory_order_item->save();
            //     }

            //     if($inventory->inventory_type == 'r'){
            //         $inventory_order_rentable_item = new InventoryOrderRentableItem();
            //         $inventory_order_rentable_item->inventory_order_id = $inventory_order->id;
            //         $inventory_order_rentable_item->inventory_id = $inventory->id;
            //         $inventory_order_rentable_item->required_quantity = $inv->required_quantity;
            //         $inventory_order_rentable_item->unit_price =  $inventory->unit_price;
            //         $inventory_order_rentable_item->total_price = $inventory->unit_price * $inv->required_quantity;
            //         $inventory_order_rentable_item->barcode_number = str_pad($inventory->id, 5, 0, STR_PAD_LEFT) . time();
            //         $inventory_order_rentable_item->save();
            //     }
            // }

            // new
        $inventory_order = new InventoryOrder();
        $inventory_order->house_repair_request_id = $request->house_repair_request_id;
        $inventory_order->house_captain_id = $request->house_captain_id;
        $inventory_order->warehouse_id = $request->warehouse_id;
        $inventory_order->save();
        // return $inventory_order;
        for($i=0; $i<count($request->inventories); $i++){
            $inventory = Inventory::find($request->inventories[$i]);
            // dd($inventory);
            // echo $request->required_quantity[$i] . '<br />';
            if($inventory->inventory_type == 's'){
                // return $i;
                // return $request->required_quantity[$i];
                // return $request->required_quantity[$i];
                $inventory_order_item = new InventoryOrderItem();
                $inventory_order_item->inventory_order_id = $inventory_order->id;
                $inventory_order_item->inventory_id = $inventory->id;
                $inventory_order_item->required_quantity = $request->required_quantity[$i];
                $inventory_order_item->unit_price =  $inventory->unit_price;
                $inventory_order_item->total_price = $inventory->unit_price * $request->required_quantity[$i];
                $inventory_order_item->save();
                // return $inventory_order_item;

                    if($inventory_order_item->save()){
                        $update_inventory = Inventory::find($inventory_order_item->inventory_id);
                        $update_inventory->update_quantity = $update_inventory->update_quantity - $inventory_order_item->required_quantity;
                        $update_inventory->save();
                    }
            }

            if($inventory->inventory_type == 'r'){
                // return "hello r";
                $inventory_order_rentable_item = new InventoryOrderRentableItem();
                $inventory_order_rentable_item->inventory_order_id = $inventory_order->id;
                $inventory_order_rentable_item->inventory_id = $inventory->id;
                $inventory_order_rentable_item->required_quantity = $request->required_quantity[$i];
                $inventory_order_rentable_item->unit_price =  $inventory->unit_price;
                $inventory_order_rentable_item->total_price = $inventory->unit_price * $request->required_quantity[$i];
                $inventory_order_rentable_item->barcode_number = str_pad($inventory->id, 5, 0, STR_PAD_LEFT) . time();
                $inventory_order_rentable_item->save();
                // return $inventory_order_rentable_item;
                    if($inventory_order_rentable_item->save()){
                        $update_inventory_rentable = Inventory::find($inventory_order_rentable_item->inventory_id);
                        $update_inventory_rentable->update_quantity = $update_inventory_rentable->update_quantity - $inventory_order_rentable_item->required_quantity;
                        $update_inventory_rentable->save();
                    }
            }
        }
            $inventory_order->grand_total_price = $this->calculateGrandTotal($inventory_order->id);
            $inventory_order->save();

            if( $inventory_order->save()){
                $update_satatus = HouseRepairRequest::find($id);
                $update_satatus->status = "work_completed";
                $update_satatus->save();
            }

            DB::commit();
            // return response()->json(['status'=>true,'message'=>'Inventory order placed successfully.']);
            return redirect(url('/housecaptain/accept',$inventory_order->id))->with('success','Order Created Successfully!');
        }catch(Throwable $e){
            dd($e->getMessage());
            DB::rollBack();
            // return response()->json(['status'=>false,'message'=>'Inventory order not placed, try again.']);
            return back();

        }
    }
    private function calculateGrandTotal($inventory_order_id){
        try{
            $inventory_order_item_total_price = 0;
            $inventory_order_rentable_item_total_price = 0;

            $inventory_order_item = InventoryOrderItem::where(['inventory_order_id' => $inventory_order_id])->get();
            $inventory_order_rentable_item = InventoryOrderRentableItem::where(['inventory_order_id' => $inventory_order_id])->get();

            
            if($inventory_order_item){
                $inventory_order_item_total_price = $inventory_order_item->sum('total_price');
            }
            if($inventory_order_rentable_item){
                $inventory_order_rentable_item_total_price = $inventory_order_rentable_item->sum('total_price');
            }
            return $inventory_order_item_total_price + $inventory_order_rentable_item_total_price;
        }catch(Throwable $e){
            throw new Exception('Grand total calculation failed');
        }
    }
    // public function returnRentableInventory(Request $request){
    //     try{
    //         $inventory_order_rentable_item = InventoryOrderRentableItem::find($request->id);
    //         $inventory_order_rentable_item->is_returned = 'y';
    //         $inventory_order_rentable_item->returned_at = Carbon::now();
    //         $inventory_order_rentable_item->save();
    //         return response()->json(['status'=>true,'message'=>'Inventory returned to warehouse.']);
    //     }catch(Throwable $e){
    //         return response()->json(['status'=>false,'message'=>'Inventory not returned to warehouse.']);
    //     }
    // }

    public function orderIndex($id){
        // return $id;
        $inventories = Inventory::get();
        // return $inventories;
        $house_repaire = $id;
        // return $product;
        return view('housecaptain.repair_request.add_order',compact('inventories','house_repaire'));
    }

    public function notification(){

        $notification = Notification::with('house_captain')->get();
        return view('housecaptain.notification',compact('notification'));
    }

   
}
