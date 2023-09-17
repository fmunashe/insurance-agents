<div class="row">
    <div class="col-lg-12">
        <div class="row tab-content">
            <div id="list-view" class="tab-pane fade active show col-lg-12">
                <div class="card">
                    <div class="card-header bg-primary">

                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>{{\Carbon\Carbon::now()->format('d-M-Y')}}</td>
                                <td></td>
                                <td></td>
                                <td>Exide Express Rusape</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>{{\Carbon\Carbon::now()->format('g:i A')}}</td>
                                <td></td>
                                <td></td>
                                <td>Sale Detail</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td>Receipt #</td>
                                <td>Receipt Type</td>
                                <td>Full Name</td>
                                <td>Qty Sold</td>
                                <td>Total Amount</td>
                                <td>Payment</td>
                            </tr>
                            @foreach($sales as $sale)
                                <tr>
                                    <td>{{\Carbon\Carbon::make($sale->created_at)->format('m/d/Y')}}</td>
                                    <td>{{$sale->invoice_number}}</td>
                                    <td>Sales</td>
                                    <td>{{$sale->customer->fullname??""}}</td>
                                    <td>{{$sale->saleItems()->sum('quantity')}}</td>
                                    <td>{{number_format($sale->saleItems()->sum('sub_total'),2)}}</td>
                                    <td>Cash</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>{{$quantity}}</td>
                                <td>{{number_format($total,2)}}</td>
                                <td></td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

