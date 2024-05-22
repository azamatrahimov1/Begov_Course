<?php

namespace App\Http\Controllers\Payme;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymeController extends Controller
{
    public function index(Request $req)
    {
        if ($req->method() == "CheckPerformTransaction") {
            if (empty($req->params['account'])) {
                $response = [
                    'id' => $req->id,
                    'error' => [
                        'code' => -3254,
                        'message' => 'Недостаточно привилегий длявыполнения метода'
                    ]
                ];
                return json_encode($response);
            } else {
                $account = $req->params['account'];
                $transaction = Order::where('id', $account['order_id'])->first();
                if (empty($t)) {
                    $response = [
                        'id' => $req->id,
                        'error' => [
                            'code' => -31050,
                            'message' => [
                                "uz" => "Buyurtma topilmadi",
                                "ru" => "Заказ не найден",
                                "en" => "Order not found"
                            ]
                        ]
                    ];
                    return json_encode($response);
                } else if ($transaction->price != $req->params['amount']) {
                    $response = [
                        'id' => $req->id,
                        'error' => [
                            'code' => -31001,
                            'message' => [
                                "uz" => "Notogri summa",
                                "ru" => "Неверная сумма",
                                "en" => "Incorrect amount",
                            ]
                        ]
                    ];
                    return json_encode($response);
                }
            }
            $response = [
                'result' => [
                    'allow' => true
                ]
            ];
            return json_encode($response);
        } //CreateTransaction
        else if ($req->method() == "CreateTransaction") {
            if (empty($req->params['account'])) {
                $response = [
                    'id' => $req->id,
                    'error' => [
                        'code' => -32504,
                        'message' => 'Bajarish usuli uchun imtiyozlar etarli emas.'
                    ]
                ];
                return json_encode($response);
            } else {
                $account = $req->params['account'];
                $order = Order::where('id', $account['order_id'])->first();
                $order_id = $req->params['account']['order_id'];
                $transaction = Transaction::where('order_id', $order_id)->where('state', 1)->get();

                if (empty($order)) {
                    $response = [
                        'id' => $req->id,
                        'error' => [
                            'code' => -31050,
                            'message' => [
                                "uz" => "Buyurtma topilmadi",
                                "ru" => "Заказ не найден",
                                "en" => "Order not found",
                            ]
                        ]
                    ];
                    return json_encode($response);
                } else if ($order->price != $req->params['amount']) {
                    $response = [
                        'id' => $req->id,
                        'error' => [
                            'code' => -31001,
                            'message' => [
                                "uz" => "Notog'ri summa",
                                "ru" => "Неверная сумма",
                                "en" => "Incorrect amount",
                            ]
                        ]
                    ];
                    return json_encode($response);
                } elseif (count($transaction) == 0) {
                    $transaction = new Transaction();
                    $transaction->paycom_transaction_id = $req->params['id'];
                    $transaction->paycom_time = $req->params['time'];
                    $transaction->paycom_time_datetime = now();
                    $transaction->amount = $req->params['amount'];
                    $transaction->state = 1;
                    $transaction->order_id = $account['order_id'];
                    $transaction->save();

                    return response()->json([
                        "result" => [
                            'create_time' => $req->params['time'],
                            'transaction' => strval($transaction->id),
                            'state' => $transaction->state
                        ]
                    ]);
                } elseif ((count($transaction) == 1) and ($transaction->first()->paycom_time == $req->params['time']) and ($transaction->first()->paycomtransaction_id == $req->params['id'])) {
                    $response = [
                        'result' => [
                            "create_time" => $req->params['time'],
                            "transaction" => "{$transaction[0]->id}",
                            "state" => intval($transaction[0]->state)
                        ]
                    ];
                    return json_encode($response);
                } else {
                    $response = [
                        'id' => $req->id,
                        'error' => [
                            'code' => -31099,
                            'message' => [
                                "uz" => "Buyurtma tolovi hozirda amalga oshirilmoqda",
                                "ru" => "Оплата заказа в данный момент обрабатывается",
                                "en" => "Order payment is currently being processed"
                            ]
                        ]
                    ];
                    return json_encode($response);
                }
            }
        } //CheckTransaction
        else if ($req->method() == "CheckTransaction") {
            $ldate = date('Y-m-d H:i:s');
            $transaction = Transaction::where('paycom_transaction_id', $req->params['id'])->first();
            if (empty($transaction)) {
                $response = [
                    'id' => $req->id,
                    'error' => [
                        'code' => -31003,
                        'message' => "Транзакция не найденна."
                    ]
                ];
                return json_encode($response);
            } else if ($transaction->state == 1) {
                $response = [
                    "result" => [
                        'create_time' => intval($transaction->payycom_time),
                        'perform_time' => intval($transaction->perform_time_unix),
                        'cancel_time' => 0,
                        'transaction' => strval($transaction->id),
                        'state' => $transaction->state,
                        'reason' => $transaction->rason
                    ]
                ];
                return json_encode($response);
            } else if ($transaction->state == 2) {
                $response = [
                    "result" => [
                        'create_time' => intval($transaction->payycom_time),
                        'perform_time' => intval($transaction->perform_time_unix),
                        'cancel_time' => 0,
                        'transaction' => strval($transaction->id),
                        'state' => $transaction->state,
                        'reason' => $transaction->rason
                    ]
                ];
                return json_encode($response);
            } else if ($transaction->state == -1) {
                $response = [
                    "result" => [
                        'create_time' => intval($transaction->payycom_time),
                        'perform_time' => intval($transaction->perform_time_unix),
                        'cancel_time' => intval($transaction->cancel_time),
                        'transaction' => strval($transaction->id),
                        'state' => $transaction->state,
                        'reason' => $transaction->rason
                    ]
                ];
                return json_encode($response);
            } else if ($transaction->state == -2) {
                $response = [
                    "result" => [
                        'create_time' => intval($transaction->payycom_time),
                        'perform_time' => intval($transaction->perform_time_unix),
                        'cancel_time' => intval($transaction->cancel_time),
                        'transaction' => strval($transaction->id),
                        'state' => $transaction->state,
                        'reason' => $transaction->rason
                    ]
                ];
                return json_encode($response);
            }
        } //PerformTransaction
        else if ($req->method() == "PerformTransaction") {
            $ldate = date('Y-m-d H:i:s');
            $transaction = Transaction::where('paycom_transaction_id', $req->params['id'])->first();
            if (empty($transaction)) {
                $response = [
                    'id' => $req->id,
                    'error' => [
                        'code' => -31003,
                        'message' => 'Транзакция не найденна'
                    ]
                ];
                return json_encode($response);
            } else if ($transaction->state == 1) {
                $currentMillis = intval(microtime(true) * 100);
                $transaction = Transaction::where('paycom_transaction_id', $req->params['id'])->first();
                $transaction->state = 2;
                $transaction->perform_time = $ldate;
                $transaction->perform_time_unix = str_replace('.', '', $currentMillis);
                $transaction->update();
                $completed_order = Order::where('id', $transaction->order_id)->first();
                $completed_order->status = 'end';
                $completed_order->update();
                $response = [
                    'result' => [
                        'transaction' => "{$transaction->id}",
                        'perform_time' => intval($transaction->perform_time_unix),
                        'state' => intval($transaction->state)
                    ]
                ];
                return json_encode($response);
            } elseif ($transaction->state == 2) {
                $response = [
                    'result' => [
                        'transaction' => strval($transaction->id),
                        'perform_time' => intval($transaction->perform_time_unix),
                        'state' => intval($transaction->state)
                    ]
                ];
                return json_encode($response);
            }
        } //CancelTransaction
        else if ($req->method() == "CancelTransaction") {
            $ldate = date('Y-m-d H:i:s');
            $transaction = Transaction::where('paycom_transaction_id', $req->params['id'])->first();
            if (empty($transaction)) {
                $response = [
                    'id' => $req->id,
                    'error' => [
                        'code' => -31003,
                        'message' => 'Транзакция не найденна'
                    ]
                ];
                return json_encode($response);
            } else if ($transaction->state == 1) {
                $currentMillis = intval(microtime(true) * 1000);
                $transaction = Transaction::where('paycom_transaction_id', $req->params['id'])->first();
                $transaction->reason = $req->params['reason'];
                $transaction->perform_time = $ldate;
                $transaction->cancel_time = str_replace('.', '', $currentMillis);
                $transaction->state = -1;
                $transaction->update();

                $order = Order::find($transaction->order_id);
                $order->update(['status' => 'Bekor qilindi']);
                $response = [
                    'result' => [
                        'state' => intval($transaction->state),
                        'cancel_time' => intval($transaction->cancel_time),
                        'transaction' => strval($transaction->id)
                    ]
                ];
                return json_encode($response);
            } else if ($transaction->state == 2) {
                $currentMillis = intval(microtime(true) * 1000);
                $transaction = Transaction::where('paycom_transaction_id', $req->params['id'])->first();
                $transaction->reason = $req->params['reason'];
                $transaction->perform_time = $ldate;
                $transaction->cancel_time = str_replace('.', '', $currentMillis);
                $transaction->state = -2;
                $transaction->update();

                $order = Order::find($transaction->order_id);
                $order->update(['status' => 'Bekor qilindi']);
                $response = [
                    'result' => [
                        'state' => intval($transaction->state),
                        'cancel_time' => intval($transaction->cancel_time),
                        'transaction' => strval($transaction->id)
                    ]
                ];
                return json_encode($response);
            } elseif (($transaction->state == -1) or ($transaction->state == -2)) {
                $response = [
                    'result' => [
                        'state' => intval($transaction->state),
                        'cancel_time' => intval($transaction->cancel_time),
                        'transaction' => strval($transaction->id)
                    ]
                ];
                return json_encode($response);
            }
        } //GetStatement
        elseif ($req->method() == "GetStatement") {
            $from = $req->params['form'];
            $to = $req->params['to'];
            $transaction = Transaction::getTransactionsByTimeRange($from, $to);

            return response()->json([
                'result' => [
                    'transaction' => TransactionResource::collection($transaction),
                ],
            ]);
        } elseif ($req->method() == "ChangePassword") {
            $response = [
                'id' => $req->id,
                'error' => [
                    'code' => -32504,
                    'message' => "Недостаточно привилигий для выполнения метода"
                ]
            ];
            return json_encode($response);
        }
    }
}
