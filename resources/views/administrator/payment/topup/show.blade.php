<x-admin.auth-layout>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Topup</h1>
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
                    <form action="{{ route('administrator.topup.update', $topup->uuid) }}" method="post">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="name_lable">Wallet Address</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ @$topup->user->wallet_address }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="network_label">Network</label>
                            <input type="text" class="form-control" id="network" name="network"
                                value="{{ @$topup->network }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="amount_submitted_label">Amount (RM)</label>
                            <input type="number" class="form-control" id="amount_submitted" name="amount_submitted"
                                value="{{ @$topup->amount_submitted }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="name_lable">User</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ @$topup->user->fname . ' ' . @$topup->user->lname }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="remarks_label">Remarks</label>
                            <textarea type="text" class="form-control" id="remarks" name="remarks" readonly>{{ @$topup->remarks ?? '-' }}</textarea>
                        </div>
                        @if (!is_null($topup->proof_file_path))
                            <a target="_blank" href="{{ asset('storage/' . $topup->proof_file_path) }}">
                                <span>Receipt Proof</span>
                            </a>
                        @endif

                        {{-- @if ($topup->state == 'in_review')
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
                    @if ($topup->state == 'in_review')
                        <div class="row mt-3">
                            @foreach ($topup->admin_button_actions() as $button)
                                <div class="col {{ $button['button_align'] }}">
                                    <a class="{{ $button['button'] }}" data-bs-toggle="modal" data-bs-target="#topupApproval{{ $button['state'] }}{{ $topup->uuid }}">
                                        {{ $button['text'] }}
                                    </a>
                                    <div class="modal fade" id="topupApproval{{ $button['state'] }}{{ $topup->uuid }}" tabindex="-1" aria-labelledby="topupApproval{{ $button['state'] }}{{ $topup->uuid }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body text-start">
                                                    <h5 class="modal-title mb-3" id="topupApproval{{ $button['state'] }}{{ $topup->uuid }}Label">
                                                        <b>
                                                            {{ $button['title'] }}
                                                        </b>
                                                    </h5>
                                                    <form action="{{ route('administrator.topup.update', $topup->uuid) }}" method="post">
                                                        @method('put')
                                                        @csrf
                                                        <input type="hidden" name="new_state" value="{{ $button['state'] }}">
                                                        <input type="hidden" name="old_state" value="{{ $topup->state }}">
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