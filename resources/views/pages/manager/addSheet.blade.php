@extends('layouts.masters.manager')
@section('content')
    {{--   要做防呆 不然授權會出錯 然後沒有筆數的時候要處理 --}}
        <div class="container">
            {{--        <div class="row mt-3 justify-content-center">--}}
            {{--            <h1 class="text-center col-lg-12 ">工作分配</h1>--}}
            {{--        </div>--}}
            <form action="{{Route('post_create_addSheet')}}" method="POST" class="workSheet">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="ticket_id">派遣單編號</label>
                        <input disabled="value" type="text" name="ticket_id" class="form-control" id="ticket_id"
                               placeholder="派遣單編號" value="{{$id+1}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date">日期</label>
                        <input type="text" name="date" class="form-control" id="date" placeholder="日期">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="employeeName">客戶名稱</label>
                        <input type="text" name="employeeName" class="form-control" id="employeeName" required
                               placeholder="客戶名稱">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="item">品項</label>
                        <select type="text" name="item" class="form-control" id="item" placeholder="品項" required>
                            <option value="毛巾">毛巾</option>
                            <option value="方巾">方巾</option>
                            <option value="浴巾">浴巾</option>
                            <option value="寬版運動巾">寬版運動巾</option>
                            <option value="窄版運動巾">窄版運動巾</option>
                            <option value="毛巾被">毛巾被</option>
                            <option value="小方巾">小方巾</option>
                            <option value="足布">足布</option>
                            <option value="枕巾">枕巾</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="itemId">貨號</label>
                        <select  name="itemId" class="form-control" id="itemId" placeholder="貨號" required>
                                <option value="CH-881">CH-881</option>
                                <option value="FW-20780">FW-20780</option>
                                <option value="TW-952">TW-952</option>
                                <option value="YDC-66260-1">YDC-66260-1</option>
                                <option value="WY-8781">WY-8781</option>
                                <option value="TZ-8915">TZ-8915</option>
                                <option value="HC-770">HC-770</option>
                                <option value="DY-800">DY-800</option>
                                <option value="BJ-2491">BJ-2491</option>
                                <option value="NST-9713">NST-9713</option>
                                <option value="HK-540">HK-540</option>
                                <option value="SM-TSB125">SM-TSB125</option>
                                <option value="GJ-2801">GJ-2801</option>
                                <option value="DU-1051">DU-1051</option>
                                <option value="MY-320-3">MY-320-3</option>
                                <option value="BT-1200">BT-1200</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="factory">漂染廠</label>
                        <select type="text" name="factory" class="form-control" id="factory" placeholder="漂染廠" required>
                            <option value="國弘">國弘</option>
                            <option value="富竹">富竹</option>
                            <option value="龍浩">龍浩</option>
                            <option value="福祿">福祿</option>
                            <option value="協發">協發</option>
                            <option value="德豐">德豐</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="color">顏色</label>
                        <select type="text" name="color" class="form-control" id="color" placeholder="顏色" required>
                            <option value="白">白</option>
                            <option value="藍">藍</option>
                            <option value="粉">粉</option>
                            <option value="黃">黃</option>
                            <option value="綠">綠</option>
                            <option value="金黃">金黃</option>
                            <option value="介黃">介黃</option>
                            <option value="紫">紫</option>
                            <option value="葡萄紫">葡萄紫</option>
                            <option value="灰">灰</option>
                            <option value="米">米</option>
                            <option value="桃紅">桃紅</option>
                            <option value="玫瑰紅">玫瑰紅</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="colorId">色線編號</label>
                        <select class="form-control" name="colorId" id="colorId" placeholder="輸入或點擊選取廠商" required>
                            <option>聯訪</option>
                            <option>廣泰</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="wash">洗標</label>
                        <select type="text" name="wash" class="form-control" id="wash" placeholder="洗標" required>
                            <option value="織物100%">織物100%</option>
                            <option value="織物90%">織物90%</option>
                            <option value="昌和奈米10%">昌和奈米10%</option>
                            <option value="黑白狗100%">黑白狗100%</option>
                            <option value="莫利仕">莫利仕</option>
                            <option value="棉王">棉王</option>
                            <option value="功夫">功夫</option>
                            <option value="打勾">打勾</option>
                            <option value="福維單片">福維單片</option>
                            <option value="彩虹">彩虹</option>
                            <option value="領先綠標">領先綠標</option>
                            <option value="領先咖標">領先咖標</option>
                            <option value="960標">960標</option>
                            <option value="140標">140標</option>
                            <option value="方格">方格</option>
                            <option value="台製藍標">台製藍標</option>
                            <option value="台製黑標">台製黑標</option>
                            <option value="公版標">公版標</option>
                            <option value="大億">大億</option>
                            <option value="寶佳">寶佳</option>
                            <option value="南斯特">南斯特</option>
                            <option value="南斯特炭標">南斯特炭標</option>
                            <option value="星紅">星紅</option>
                            <option value="雙星印標">雙星印標</option>
                            <option value="雙星織標">雙星織標</option>
                            <option value="金磚">金磚</option>
                            <option value="箏緣">箏緣</option>
                            <option value="本土">本土</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="colorId2">色線編號2</label>
                        <select type="text" name="colorId2" class="form-control" id="colorId2" placeholder="色線編號" required>
                            <option value="048">048</option>
                            <option value=352">352</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="rollFunc">滾邊方式</label>
                    <select type="text" name="rollFunc" class="form-control" id="rollFunc" placeholder="滾邊方式" required>
                        <option value="2線">2線</option>
                        <option value="5線">5線</option>
                        <option value="6線">6線</option>
                    </select>
                </div>
                {{--        訂單數量未調整        --}}
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="order">訂單數量</label>
                        <input type="text" name="order" class="form-control" id="order" placeholder="訂單數量" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="order_unit">訂單單位</label>
                        <select type="text" name="order_unit" class="form-control" id="order_unit" placeholder="單位" required>
                            <option value="1" selected>條</option>
                            <option value="12">打</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="manager">派工主管</label>
                    <input type="text" name="manager" class="form-control" id="manager" placeholder="派工主管" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="ps">備註</label>
                        <input type="text" name="ps" class="form-control" id="ps" placeholder="備註">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="status">貨別</label>
                        <select class="form-control" name="status" id="status"
                               placeholder="輸入或點擊選取狀態">
                            <option value="排程中">排程中</option>
                            <option value="刪單">刪單</option>
                            <option value="出貨">出貨</option>
                        </select>
                    </div>
                </div>

                <div style="width:800px; display: flex;" class="column">
                    <form id="form_open_scanner" action="{{url('/openScanner/ManagerToPiping/'.$id)}}">
                        <input id="btn_open_scanner" type="button" class="btn btn-secondary" value="Qrcode授權"/>
                        <input id="camera_link_for_iphone" type="file" accept="image/*" style="display: none" capture/>
                    </form>
                    <button style="width: 100px;" type="submit"
                            class="btn_add form-control btn btn-secondary rounded mx-3">
                        儲存
                    </button>
                    <button style="width: 100px;" type="button"
                            class="btn_print form-control btn btn-secondary rounded mx-3" onclick="window.print()">列印
                    </button>
                </div>
            </form>
        </div>

        <script>
            ;(function () {
                const d = new Date()
                const date = document.getElementById("date");
                date.value = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate()+" "+d.getHours()+":"+d.getMinutes();
                document.getElementById("btn_open_scanner").addEventListener("click",function(){
                    //獲取系統裝置資訊
                    let agent = navigator.userAgent.toLowerCase();

                    //若裝置為 Android
                    if (agent.includes("android")){
                        window.location.href = "app://open";
                        $("form_open_scanner").submit();
                    }
                    //若裝置為 iphone
                    else if (agent.includes("iphone")){
                        document.getElementById("camera_link_for_iphone").click();
                        $("form_open_scanner").submit();
                    }
                    //其他裝置
                    else{
                        window.alert("此功能僅限於Android或ios裝置使用!");
                    }
                })
                $("#itemId").editableSelect({efficts: 'slide'})
                $("#color").editableSelect({efficts: 'slide'})
                $("#wash").editableSelect({efficts: 'slide'})
                $("#item").editableSelect({efficts: 'slide'})
                $("#factory").editableSelect({efficts: 'slide'})
                $("#colorId").editableSelect({efficts: 'slide'})
                $("#colorId2").editableSelect({efficts: 'slide'})
                $("#rollFunc").editableSelect({efficts: 'slide'})
                $("#status").editableSelect({efficts: 'slide'})
            })()
        </script>
@endsection


