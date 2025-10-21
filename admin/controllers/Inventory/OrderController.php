<?php
class OrderController extends Controller{
    public function __construct(){ }

    // --- Show order list ---
    public function index(){
        view("Inventory");
    }

    // --- Show create order form ---
    public function create(){
        view("Inventory");
    }

    // --- Save new order ---
    public function save($data, $file){
        if(isset($data["create"])){
            $errors = [];
            $now = date('Y-m-d H:i:s');

            // Validate required fields
            if(empty($data["customer_id"])) $errors[] = "Customer is required";
            if(empty($data["restaurant_id"])) $errors[] = "Restaurant is required";
            if(empty($data["items"]) || !is_array($data["items"])) $errors[] = "At least one menu item is required";

            if(count($errors) > 0){
                print_r($errors);
                return;
            }

            // --- Save Main Order ---
            $order = new Order();
            $order->customer_id = $data["customer_id"];
            $order->rider_id = $data["rider_id"] ?? null;
            $order->restaurant_id = $data["restaurant_id"];
            $order->delivery_address = $data["delivery_address"];
            $order->total_amount = $data["grand_total"] ?? 0;
            $order->delivery_fee = $data["delivery_fee"] ?? 0;
            $order->tax_amount = $data["tax"] ?? 0;
            $order->coupon_id = $data["coupon_id"] ?? null;
            $order->tracking_id = uniqid("TRK");
            $order->payment_status = $data["payment_status"] ?? 'pending';
            $order->created_at = $now;
            $order->updated_at = $now;
            $order->version = 1;

            $order_id = $order->save(); // Save main order & get ID

            // --- Save Order Items ---
            if(!empty($data['items'])){
                foreach($data['items'] as $item){
                    if(!empty($item['menu_item_id'])){
                        $detail = new OrderDetail();
                        $detail->order_id = $order_id;
                        $detail->menu_item_id = $item['menu_item_id'];
                        $detail->qty = $item['qty'];
                        $detail->unit_price = $item['unit_price'];
                        $detail->total_price = $item['qty'] * $item['unit_price'];
                        $detail->notes = $item['notes'] ?? '';
                        $detail->created_at = $now;
                        $detail->save();
                    }
                }
            }

            redirect("order/show/$order_id");
        }
    }

    // --- Update existing order ---
    public function update($data, $file){
        $now = date('Y-m-d H:i:s');

        if(isset($data["update"])){
            $errors=[];

            if(empty($data["customer_id"])) $errors[] = "Customer is required";
            if(empty($data["restaurant_id"])) $errors[] = "Restaurant is required";

            if(count($errors)==0){
                $order = new Order();
                $order->id = $data["id"];
                $order->customer_id = $data["customer_id"];
                $order->rider_id = $data["rider_id"] ?? null;
                $order->restaurant_id = $data["restaurant_id"];
                $order->delivery_address = $data["delivery_address"];
                $order->total_amount = $data["total_amount"];
                $order->delivery_fee = $data["delivery_fee"];
                $order->tax_amount = $data["tax_amount"];
                $order->coupon_id = $data["coupon_id"] ?? null;
                $order->tracking_id = $data["tracking_id"];
                $order->payment_status = $data["payment_status"];
                $order->created_at = $now;
                $order->updated_at = $now;
                $order->version = $data["version"] ?? 1;

                $order->update();

                // Optional: update order items here

                redirect("order/show/".$data["id"]);
            } else {
                print_r($errors);
            }
        }
    }

    // --- Delete order ---
    public function delete($id){
        Order::delete($id);
        redirect("order");
    }

    // --- Show single order ---
    public function show($id){
        view("Inventory", Order::find($id));
    }

    // --- AJAX: Fetch delivery address by customer ---
    public function fetch_address($customer_id){
        $customer_id = intval($customer_id);
        $address = '';
        $orders = Order::pagination(1,1,"WHERE customer_id=$customer_id ORDER BY created_at DESC");
        if(!empty($orders)) $address = $orders[0]->delivery_address;
        echo json_encode(['address'=>$address]);
        exit;
    }

    // --- AJAX: Fetch menu items by restaurant ---
    public function fetch_menu($restaurant_id){
        global $db;
        $restaurant_id = intval($restaurant_id);
        $data = [];
        if($restaurant_id){
            $result = $db->query("SELECT id, name, price FROM menu_items WHERE restaurant_id=$restaurant_id AND is_active=1");
            while($row = $result->fetch_object()) $data[] = $row;
        }
        echo json_encode($data);
        exit;
    }

    // --- Optional: Confirm order page ---
    public function confirm($id){
        view("Inventory");
    }
}
?>
