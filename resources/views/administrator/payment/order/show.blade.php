<x-admin.auth-layout>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Order Payment</h1>
    </div>
    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <h6 class="m-0 font-weight-bold text-primary"> Details </h6>
                        </div>
                        <div class="col text-end">
                            <a class="btn btn-primary" href="{{ route('administrator.order.show', $payment->order->uuid) }}">Order Details</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('administrator.order-payment.update', $payment->uuid) }}" method="post">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="amount_submitted_label">Amount (RM)</label>
                            <input type="number" class="form-control" id="amount_submitted" name="amount_submitted"
                                value="{{ @$payment->amount_submitted }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="name_lable">Bank Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $payment ? $payment->bank_name : '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="name_lable">Acc Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $payment ? $payment->bank_account_name : '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="name_lable">Acc Number</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $payment ? $payment->bank_account_number : '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="remarks_label">Remarks</label>
                            <textarea type="text" class="form-control" id="remarks" name="remarks" readonly>{{ @$payment->remarks ?? '-' }}</textarea>
                        </div>
                        @if (!is_null($payment->proof_file_path))
                            <a target="_blank" href="{{ asset('storage/' . $payment->proof_file_path) }}">
                                <span>Receipt Proof</span>
                            </a>
                        @endif

                        {{-- @if ($payment->state == 'in_review')
                            <div class="form-group mt-3">
                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-success" type="submit" name="btn" value="approved">Approved</button>
                                    </div>
                                    <div class="col text-end">
                                        <button class="btn btn-danger" type="submit" name="btn" value="rejected">Reject</button>
                                    </div>
                                </div>
                            </div>
                        @endif --}}
                    </form>
                    @if ($payment->state == 'in_review')
                        <div class="row mt-3">
                            @foreach ($payment->admin_button_actions() as $button)
                                <div class="col {{ $button['button_align'] }}">
                                    <a class="{{ $button['button'] }}" data-bs-toggle="modal" data-bs-target="#paymentApproval{{ $button['state'] }}{{ $payment->uuid }}">
                                        {{ $button['text'] }}
                                    </a>
                                    <div class="modal fade" id="paymentApproval{{ $button['state'] }}{{ $payment->uuid }}" tabindex="-1" aria-labelledby="paymentApproval{{ $button['state'] }}{{ $payment->uuid }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body text-start">
                                                    <h5 class="modal-title mb-3" id="paymentApproval{{ $button['state'] }}{{ $payment->uuid }}Label">
                                                        <b>
                                                            {{ $button['title'] }}
                                                        </b>
                                                    </h5>
                                                    <form action="{{ route('administrator.order-payment.update', $payment->uuid) }}" method="post">
                                                        @method('put')
                                                        @csrf
                                                        <input type="hidden" name="new_state" value="{{ $button['state'] }}">
                                                        <input type="hidden" name="old_state" value="{{ $payment->state }}">
                                                        <div class="mb-4">
                                                            {{ $button['description'] }}
                                                        </div>
                                                        <div class="mt-3">
                                                            <div class="row">
                                                                <div class="col text-start">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                                <div class="col text-end">
                                                                    <button name="btn" value="{{ $button['state']  }}" class="btn btn-danger">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin.auth-layout>