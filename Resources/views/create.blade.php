@extends('core::layouts.admin.app')

@section('title', __('Create Purchase'))

@section('content')
    <div class="row">
        <div class="col-md-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Add Purchase') }}</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.purchase.index') }}" class="btn btn-primary">
                            <i class="fas fa-align-justify"></i> {{ __('Purchase List') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.purchase.store') }}" method="post" class="instant_reload_form">
                        @csrf
                        <div class="form-group row">
                            <label for="manufacturer" class="col-md-2 text-right col-form-label required">{{ __("Manufacturer") }}</label>
                            <div class="col-md-4">
                                <select name="manufacturer" id="manufacturer" data-placeholder="{{ __("Select Manufacturer") }}" tabindex="1" required>
                                    <option value=""></option>
                                </select>
                            </div>
                            <label for="purchase_date" class="col-md-2 text-right col-form-label required">{{ __('Purchase Date') }}</label>
                            <div class="col-md-4">
                                <input type="text" name="purchase_date" class="form-control datepicker" id="purchase_date"
                                       placeholder="{{ __("Enter Purchase date") }}" value="{{ today()->format('Y-m-d') }}" tabindex="2" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="invoice_no" class="col-md-2 text-right col-form-label required">{{ __("Invoice No") }}</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="invoice_no" id="invoice_no" placeholder="{{ __("Enter invoice no") }}" tabindex="3" required>
                            </div>
                            <label for="details" class="col-md-2 text-right col-form-label">{{ __("Details") }}</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="details" id="details" placeholder="{{ __('Enter Details') }}" tabindex="4">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="payment_type" class="col-md-2 text-right col-form-label required">{{ __("Payment Type") }}</label>
                            <div class="col-md-4">
                                <select name="payment_type" id="payment_type" data-control="select2" data-placeholder="{{ __('Select Payment Type') }}" onchange="bank_payment(this.value)" tabindex="5">
                                    <option value="1" selected="selected">{{ __("Payment By Cash") }}</option>
                                    <option value="2">{{ __("Payment By Bank") }}</option>
                                </select>
                            </div>

                            <label for="bank" class="col-md-2 text-right bank_div col-form-label required">{{ __("Bank") }}</label>
                            <div class="col-md-4">
                                <select name="bank" id="bank" data-control="select2" data-placeholder="{{ __('Select Bank') }}"></select>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="purchaseTable">
                                <thead>
                                <tr>
                                    <th class="text-center">
                                        <nobr class="required">{{ __("Medicine Information") }}</nobr>
                                    </th>
                                    <th class="text-center">
                                        <nobr class="required">{{ __("Batch ID") }}</nobr>
                                    </th>
                                    <th class="text-center">
                                        <nobr class="required">{{ __('Expire Date') }}</nobr>
                                    </th>
                                    <th class="text-center">
                                        <nobr>{{ __('Stock Qyt.') }}</nobr>
                                    </th>
                                    <th class="text-center">
                                        <nobr class="required">{{ __('Box Pattern') }}</nobr>
                                    </th>
                                    <th class="text-center">
                                        <nobr class="required">{{ __("Box Qyt.") }}</nobr>
                                    </th>
                                    <th class="text-center">
                                        <nobr class="required">{{ __("Quantity") }}</nobr>
                                    </th>
                                    <th class="text-center">
                                        <nobr class="required">{{ __("Manufacturer Rate") }}</nobr>
                                    </th>
                                    <th class="text-center">
                                        <nobr class="required">{{ __('Box MRP') }}</nobr>
                                    </th>
                                    <th class="text-center">
                                        <nobr>{{ __("Total Purchase Price") }}</nobr>
                                    </th>
                                    <th class="text-center">
                                        <nobr>{{ __("Action") }}</nobr>
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="addPurchaseItem">
                                <tr>
                                    <td class="span3 manufacturer">
                                        <input type="text" name="product_name" required
                                               class="form-control"
                                               placeholder="{{ __("Enter medicine name") }}"
                                               tabindex="6"
                                        >
                                    </td>
                                    <td>
                                        <input type="text" name="batch_id" class="form-control text-right" tabindex="7"
                                               placeholder="{{ __("Enter batch id") }}"/>
                                    </td>
                                    <td>
                                        <input type="text" name="expire_date"
                                               class="form-control" tabindex="8"
                                               placeholder="{{ __("Enter expire date") }}"
                                               required/>
                                    </td>

                                    <td>
                                        <input type="text" class="form-control text-right" placeholder="0.00" readonly/>
                                    </td>
                                    <td>
                                        <select name="leaf" data-control="select2" data-placeholder="{{ __("Select Leaf Type") }}">

                                        </select>
                                    </td>

                                    <td class="text-right">
                                        <input type="text" name="box_quantity"
                                               class="form-control text-right"
                                               placeholder="0.00" value="" min="0"
                                               tabindex="10" required="required"/>
                                    </td>

                                    <td class="text-right">
                                        <input type="text" name="product_quantity"
                                               class="form-control text-right"
                                               placeholder="0.00" value="" min="0"
                                               required="required" readonly=""/>
                                    </td>
                                    <td>
                                        <input type="text" name="product_rate"
                                               class="form-control text-right" placeholder="0.00"
                                               value="" min="0" tabindex="11" required="required"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="mrp" required tabindex="12">
                                    </td>

                                    <td class="text-right">
                                        <input class="form-control text-right" type="text" name="total_price"
                                               value="0.00" readonly="readonly"/>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" tabindex="13">
                                                <i class="far fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>

                                    <td class="text-right" colspan="9"><b>{{ __("Sub Total") }}</b></td>
                                    <td class="text-right">
                                        <input type="text" id="sub_total" class="text-right form-control" name="sub_total"
                                               placeholder="0.00" readonly=""/>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info" tabindex="14">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>

                                    <td class="text-right" colspan="9"><b>{{ __("Vat") }}</b></td>
                                    <td class="text-right">
                                        <input type="text" id="vat"
                                               class="text-right form-control" name="vat" placeholder="0.00"
                                               tabindex="15"/>
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>

                                    <td class="text-right" colspan="9"><b>{{ __("Discount") }}</b></td>
                                    <td class="text-right">
                                        <input type="text" id="discount"
                                               class="text-right form-control" name="discount" placeholder="0.00"
                                               tabindex="16"/>
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>

                                    <td class="text-right" colspan="9"><b>{{ __('Grand Total') }}</b></td>
                                    <td class="text-right">
                                        <input type="text" id="grandTotal" class="text-right form-control"
                                               name="grand_total_price" value="0.00" readonly="readonly"/>
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>

                                    <td class="text-right" colspan="9"><b>{{ __('Paid Amount') }}</b></td>
                                    <td class="text-right">
                                        <input type="text" id="paid_amount" class="text-right form-control"
                                               name="paid_amount" placeholder="0.00"
                                               tabindex="18"/>
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>

                                    <td class="text-right" colspan="9"><b>{{ __("Due Amount") }}</b></td>
                                    <td class="text-right">
                                        <input type="text" id="due_amount" class="text-right form-control" name="due_amount"
                                               placeholder="0.00" readonly="readonly"/>
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-12 mt-4 text-right">
                            <button type="submit" class="btn btn-primary submit-button">
                                <i class="fas fa-save"></i> {{ __("Save") }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('pageCss')
    <style>
        .table:not(.table-sm):not(.table-md):not(.dataTable) td, .table:not(.table-sm):not(.table-md):not(.dataTable) th{
            padding: 0.30rem;
        }
    </style>
@endpush

@push('pageScripts')
    <script>
        $(document).ready(function () {
            $("#manufacturer").select2({
                ajax: {
                    type: 'post',
                    url: "{{ route('admin.purchase.search-manufacturer') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.data,
                            pagination: {
                                more: (params.page * data.per_page) < data.total
                            }
                        };
                    },
                    cache: true
                },
                minimumInputLength: 2,
                templateResult: formatState,
                templateSelection: formatTemplateSelection
            });


            function formatState (state) {
                if (state.loading) {
                    return state.text;
                }

                return $(
                    '<div class="d-flex align-items-center">'+
                    '<figure class="avatar mr-2 avatar-sm mr-3"><img src="'+state.avatar+'"/></figure>'+
                    '<span> ' + state.text + '</span>'+
                    '</div>'
                    // '<span><img src="'+state.image+'" class="img-flag" /> ' + state.text + '</span>'
                );
            }

            function formatTemplateSelection(state) {
                if (!state.id){
                    return state.text;
                }

                return $(
                    '<div class="d-flex align-items-center">'+
                    '<figure class="avatar mr-2 avatar-sm mr-3"><img src="'+state.avatar+'"/></figure>'+
                    '<span> ' + state.text + '</span>'+
                    '</div>'
                    // '<span><img src="'+state.image+'" class="img-flag" /> ' + state.text + '</span>'
                );
            }
        })
    </script>
@endpush

