<x-admin.auth-layout>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Withdraw</h1>
    </div>
    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> Details</h6>
                </div>
                <div class="card-body">
                    <form id="form" action="{{ route('administrator.withdraw.update', $withdraw->uuid) }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group mb-4">
                            <label for="amount_approved_label">Amount Approved
                                <span class="text-danger required">*</span>
                            </label>
                            <input type="number" class="form-control" value="{{ old('amount_approved', $withdraw->amount_approved ?? @$withdraw->amount_submitted) }}" id="amount_approved" name="amount_approved" step="any">
                        </div>

                        <div class="form-group">
                            <label for="name_lable">Wallet Address</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ @$withdraw->user->wallet_address }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="network_label">Network</label>
                            <input type="text" class="form-control" id="network" name="network"
                                value="{{ @$withdraw->network }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="amount_submitted_label">Amount (RM)</label>
                            <input type="number" class="form-control" id="amount_submitted" name="amount_submitted"
                                value="{{ @$withdraw->amount_submitted }}" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label for="name_lable">User</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ @$withdraw->user->fname . ' ' . @$withdraw->user->lname }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="remarks_label">Remarks</label>
                            <textarea type="text" class="form-control" id="remarks" name="remarks" readonly>{{ @$withdraw->remarks }}</textarea>
                        </div>
                        @if (!is_null($withdraw->proof_file_path))
                            <a target="_blank" href="{{ asset('storage/' . $withdraw->proof_file_path) }}">
                                <span>Receipt Proof</span>
                            </a>
                        @else
                            <div class="form-group mb-4">
                                <label for="remarks_label">Receipt
                                    <span class="text-danger required">*</span>
                                </label>
                                <input type="file" class="form-control" name="proof_file_path" id="proof_file_path">
                            </div>
                        @endif


                        {{-- @if ($withdraw->state == 'in_review')
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
                    
                        @if ($withdraw->state == 'in_review')
                            <div class="row mt-3">
                                @foreach ($withdraw->admin_button_actions() as $button)
                                    <div class="col {{ $button['button_align'] }}">
                                        <a class="{{ $button['button'] }}" data-bs-toggle="modal" data-bs-target="#withdrawApproval{{ $button['state'] }}{{ $withdraw->uuid }}">
                                            {{ $button['text'] }}
                                        </a>
                                        <div class="modal fade" id="withdrawApproval{{ $button['state'] }}{{ $withdraw->uuid }}" tabindex="-1" aria-labelledby="withdrawApproval{{ $button['state'] }}{{ $withdraw->uuid }}Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body text-start">
                                                        <h5 class="modal-title mb-3" id="withdrawApproval{{ $button['state'] }}{{ $withdraw->uuid }}Label">
                                                            <b>
                                                                {{ $button['title'] }}
                                                            </b>
                                                        </h5>
                                                        <input type="hidden" name="new_state" value="{{ $button['state'] }}">
                                                        <input type="hidden" name="old_state" value="{{ $withdraw->state }}">
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin.auth-layout>