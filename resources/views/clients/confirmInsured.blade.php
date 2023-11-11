<?php
/**
 * Author: Farai Zihove
 * Mobile: +263778234258
 * Email: zihovem@gmail.com
 * Date: 13/7/2023
 * Time: 17:54
 */
?>
<div class="modal fade" id="confirmInsuredModal_{{$insured->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('insurance.destroy',$insured->id)}}" method="post">
                @csrf
                @method('delete')
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Confirm Delete</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to delete the record below? This action is permanent</p>
                    <table class="table table-responsive-sm">
                        <tr>
                            <td>Policy</td>
                            <td>{{$insured->policy_number}}</td>
                        </tr>
                        <tr>
                            <td>Provider</td>
                            <td>{{$insured->provider->name??""}}</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
