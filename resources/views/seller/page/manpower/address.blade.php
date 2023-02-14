<div class="tab-pane fade" id="address" role="tabpanel">
    <h3 class="account-sub-title d-none d-md-block mb-1"><i
            class="sicon-location-pin align-middle mr-3"></i>Products</h3>
    <div class="order-table-container text-center">
        <button style="width: 300px;height: 41px;" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add Category</button>

        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Products</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{ route('seller.update.cat') }}">
                        @csrf
                        <div style="height: 500px;" class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class='c-filter'>
                                            <div style="width: 100% !important" class='c-filter__toggle'>Chose your Categories</div>
                                            <ul class='c-filter__ul'>
                                                @foreach($allCats as $allCat)
                                                    <li class='c-filter__item'><input type='checkbox' name="subCat[]" value='{{ $allCat->id }}'><label tabindex='-1' for='1'>{{ $allCat->title }}</label></li>
                                                @endforeach
                                                    <li class='c-filter__item'><input type='checkbox' name="subCat[]" value='other'><label tabindex='-1' for='1'>other</label><input type="text" name="new_sub_cat" placeholder="Other"></li>

                                                </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <table class="table table-order text-left">
            <thead>
            <tr>
                <th class="order-id">Subcategory</th>
                <th class="order-date">Products Number</th>
                <th class="order-action">ACTIONS</th>
            </tr>
            </thead>
            <tbody>
            @foreach($subcats as $subcat)
                <tr>
                <td>{{ $subcat->subCat->title }}</td>
                <td>{{ count($subcat->subCat->allproduct) }}</td>
                <td>
                    <div class="action">
                        <a href="{{ route('seller.products',$hashids->encode($subcat->subCat->id)) }}" class="btn btn-primary">Enter</a>
                    </div>
                </td>
            </tr>
            @endforeach

            </tbody>
        </table>
        <hr class="mt-0 mb-3 pb-2" />
    </div>
</div><!-- End .tab-pane -->
