<div class="tab-pane fade" id="edit" role="tabpanel">
    <h3 class="account-sub-title d-none d-md-block mt-0 pt-1 ml-1"><i
            class="icon-user-2 align-middle mr-3 pr-1"></i>Account Details</h3>
    <div class="account-content">
        <form action="{{ route('seller.account.edit') }}" enctype="multipart/form-data" method="POST">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="acc-name"> name <span class="required">*</span></label>
                        <input type="text" class="form-control" value="{{ auth()->user()->name }}"
                               id="acc-name" name="name" required />
                    </div>
                </div>

            </div>
            <div class="form-group mb-4">
                <label for="acc-email">Email address <span class="required">*</span></label>
                <input type="email" class="form-control" id="acc-email" name="email"
                       value="{{ auth()->user()->email }}" required />
            </div>
            <div class="form-group mb-4">
                <label for="acc-email">Phone <span class="required">*</span></label>
                <input type="email" class="form-control" id="acc-email" name="phone"
                       value="{{ auth()->user()->phone }}" required />
            </div>

            <div class="form-group mb-4">
                <label for="acc-image">Profile Image </label>
                <input type="file" class="form-control" id="acc-image" name="image"  />
            </div>
            @if(auth('seller')->user()->seller_type == 1)
                <div class="form-group mb-4">
                    <label for="acc-image">CV <span class="required">*</span></label>
                    <input type="file" class="form-control" id="acc-image" name="cv"  />
                </div>
            @elseif(auth('seller')->user()->seller_type == 2)
                <div class="form-group mb-4">
                    <label for="acc-image">Registration Certificate </label>
                    <input type="file" class="form-control" id="acc-image" name="registration_certificate"  />
                </div>
                <div class="form-group mb-4">
                    <label for="acc-image">Tax Card </label>
                    <input type="file" class="form-control" id="acc-image" name="tax_card"  />
                </div>
                <div class="form-group mb-4">
                    <label for="acc-image">vat Certificate</label>
                    <input type="file" class="form-control" id="acc-image" name="vat_cert"  />
                </div>
                <div class="form-group mb-4">
                    <label for="acc-image">E-Invoice </label>
                    <input type="file" class="form-control" id="acc-image" name="invoice"  />
                </div>
                <div class="form-group mb-4">
                    <label for="acc-image">Delegation </label>
                    <input type="file" class="form-control" id="acc-image" name="delgation"  />
                </div>
                <div class="form-group mb-4">
                    <label for="acc-image">Reference List </label>
                    <input type="file" class="form-control" id="acc-image" name="reference_list"  />
                </div>
            @endif


            <div class="change-password">
                <h3 class="text-uppercase mb-2">Password Change</h3>
                <div class="form-group">
                    <label for="acc-password">New Password (leave blank to leave
                        unchanged)</label>
                    <input type="password" class="form-control" id="acc-new-password"
                           name="password" />
                </div>

                <div class="form-group">
                    <label for="acc-password">Confirm New Password</label>
                    <input type="password" class="form-control" id="acc-confirm-password"
                           name="password_confirmation" />
                </div>
            </div>

            <div class="form-footer mt-3 mb-0">
                <button type="submit" class="btn btn-dark mr-0">
                    Save changes
                </button>
            </div>
        </form>
    </div>
</div><!-- End .tab-pane -->
