@extends('layouts.master')

@section('head')
    <title>VK Ludo Player-Play Ludo King Win Real Money</title>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <style>
        .form-control:disabled,
        .form-control[readonly] {
            background-color: #454647 !important;
            color: #fff !important;
        }
    </style>
@endsection



@section('content')
    <div class="main-area" style="padding-top: 60px; background: #000">
        <div class="p-3" style="background: #1c1c1c;">
            <div class="center-xy py-2">
                <picture>
                    <img class="border-50" height="50px" width="50px"
                        src="{{ asset('/images/profilesImage/' . $user->image) }}" alt="">
                    <img class="" width="20px" style="margin-left:-15px;"
                        src="{{ asset('frontend/images/icon-edit.jpg') }}" alt="" onclick="editImage()">
                </picture>
                <span class="battle-input-header mr-1">+91{{ $user->mobile }}</span>
                <div class="mt-2 w-100">
                    <lable class="text-white">Username</lable>
                    <div class="d-flex w-100">
                        <input type="text" readonly id="vplayInput" value="{{ $user->vplay_id }}" class="form-control"
                            style="margin-left:">
                        <button class="btn btn-sm btn-primary" id="editSaveBtn" onclick="toggleEditSave()"
                            style="margin-left:5px">Edit</button>
                    </div>
                </div>
            </div>
            <div class="new_profile_form" style="padding:30px;">
                <form action="{{ url('update-profile-picture') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="MuiFormControl-root MuiTextField-root" style="vertical-align: bottom;">
                        <div
                            class="MuiInputBase-root MuiInput-root MuiInput-underline MuiInputBase-formControl MuiInput-formControl">
                            <input aria-invalid="false" type="file" placeholder="Enter Username"
                                class="MuiInputBase-input MuiInput-input " value="" name="profile_image">
                            <input type="submit" value="Change Image" class="btn btn-primary btn-xs btn-sm">
                        </div>
                    </div>
                </form>
            </div>
            <div class="vplay_new_id" style="padding:30px;">
                <div class="MuiFormControl-root MuiTextField-root" style="vertical-align: bottom;">
                    <div
                        class="MuiInputBase-root MuiInput-root MuiInput-underline MuiInputBase-formControl MuiInput-formControl">
                        <input aria-invalid="false" type="text" placeholder="Enter Username"
                            class="MuiInputBase-input MuiInput-input username" value="">
                    </div>
                </div><img onclick="saveVplayId()" class="ml-2" width="20px"
                    src="{{ asset('frontend/images/select-blue-checkIcon.png') }}" alt="">
            </div>
            <?php $userData = App\UserData::where('user_id', Auth::user()->id)->first(); ?>
            @if ($userData->verify_status != 1)
                <div class="d-flex flex-row align-items-center justify-content-between p-3 border-danger card bg-outline text-white"
                    style="background: transparent;">
                    <div class="d-flex flex-column align-items-start justify-content-center">
                        <span style="font-size: 0.8rem;">KYC status</span>
                        <span class="fw-bold text-capitalize">pending
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"
                                fill="red">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z">
                                </path>
                            </svg>
                        </span>
                    </div>
                    <div>
                        <a href="{{ url('/complete-kyc/step1') }}"><button
                                class="btn btn-outline-danger btn-sm text-capitalize">complete KYC</button></a>
                    </div>
                </div>
            @else
                <div class="d-flex flex-row align-items-center justify-content-between p-3 border-danger card bg-outline text-white"
                    style="background: transparent;">
                    <div class="d-flex flex-column align-items-start justify-content-center">
                        <span style="font-size: 0.8rem;">KYC status</span>
                        <span class="fw-bold text-capitalize">Verified
                            <img src="https://cdn-icons-png.flaticon.com/128/7595/7595571.png" style="width: 25px">
                        </span>
                    </div>
                    <div>
                        <a href="{{ url('/complete-kyc/step1') }}"><button
                                class="btn btn-outline-success btn-sm text-capitalize">complete KYC</button></a>
                    </div>
                </div>
            @endif
        </div>
        <?php
        $battle_details = App\Battle::where('winner_id', Auth::user()->id)->get();
        $total_won_amount = 0;
        foreach ($battle_details as $battle) {
            $total_won_amount += $battle->prize - $battle->entry_fee;
        }
        ?>
        <?php
        $battle_created = App\BattleHistory::where('another_player_id', Auth::user()->id)->count();
        ?>


        <?php
        $penelty = App\TransactionHistory::where('user_id', Auth::user()->id)->get();
        $total_penelty = 0;
        foreach ($penelty as $battle) {
            if ($battle->withdraw_status == 'penelty') {
                $total_penelty += $battle->amount;
            }
        }

        ?>
        <div class="rounded mt-2" style="background: #1c1c1c;">
            <div class="p-2" style="background: #1c1c1c">
                <center>

                    <div class="text-white card-header border border-white">
                        <b>Metrics</b>
                    </div>
                </center>
                <div class="card-body" style="border: 1px solid #fff;">
                    <div class="g-0 gx-2 mb-2 row">
                        <div class="col">
                            <div class="d-flex flex-column align-items-stretch justify-content-start h-100 w-100 card bg-dark text-white">
                                <div class="text-capitalize text-start px-2 card-header" style="font-size: 0.9rem;">
                                    <div class="hstack gap-1 minBreakpoint-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-dice-5" viewBox="0 0 16 16">
                                            <path
                                                d="M13 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h10zM3 0a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3H3z" />
                                            <path
                                                d="M5.5 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm4-4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                        </svg>
                                        <span>games played</span>
                                    </div>
                                </div>
                                <div class="fs-5 fw-semibold text-start py-1 px-2 card-body"
                                    style="font-weight:bold; font-size: 22px;">{{ $battle_created }}</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex flex-column align-items-stretch justify-content-start h-100 w-100 card bg-dark text-white">
                                <div class="text-capitalize text-start px-2 card-header" style="font-size: 0.9rem;">
                                    <div class="hstack gap-1 minBreakpoint-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16"
                                            height="16" fill="currentColor">
                                            <path
                                                d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z">
                                            </path>
                                            <path
                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z">
                                            </path>
                                            <path
                                                d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z">
                                            </path>
                                        </svg>
                                        <span>total earning</span>
                                    </div>
                                </div>
                                <div class="fs-5 fw-semibold text-start py-1 px-2 card-body"
                                    style="font-weight:bold; font-size: 22px;">₹ {{ $total_won_amount }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="g-0 gx-2 row">
                        <div class="col">
                            <div class="d-flex flex-column align-items-stretch justify-content-start h-100 w-100 card bg-dark text-white">
                                <div class="text-capitalize text-start px-2 card-header" style="font-size: 0.9rem;">
                                    <div class="hstack gap-1 minBreakpoint-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16"
                                            height="16" fill="currentColor">
                                            <path
                                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z">
                                            </path>
                                            <path fill-rule="evenodd"
                                                d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z">
                                            </path>
                                            <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"></path>
                                        </svg>
                                        <span>referral earning</span>
                                    </div>
                                </div>
                                <div class="fs-5 fw-semibold text-start py-1 px-2 card-body">
                                    <p style="font-weight:bold; font-size: 22px;">₹{{ Auth::user()->wallet_reffer }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex flex-column align-items-stretch justify-content-start h-100 w-100 card bg-dark text-white">
                                <div class="text-capitalize text-start px-2 card-header" style="font-size: 0.9rem;">
                                    <div class="hstack gap-1 minBreakpoint-xs"><svg xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 16 16" width="16" height="16" fill="currentColor">
                                            <path
                                                d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z">
                                            </path>
                                        </svg>
                                        <span>Penalty</span>
                                    </div>
                                </div>
                                <div class="fs-5 fw-semibold text-start py-1 px-2 card-body">
                                    <p style="font-weight:bold; font-size: 22px;">{{ $total_penelty }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-grid py-2 mt-2 container">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();  document.getElementById('logout-form').submit();"
                class="text-capitalize btn btn-outline-danger btn-lg btn-block">Log Out</a>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">


            @csrf
        </form>

        <div class="kyc-select">
            <div class="overlay"></div>
            <div class="box" style="bottom: 0px; position: absolute;">
                <div class="bg-white">
                    <div class="header cxy flex-column">
                        <picture><img class="border-50" height="80px" width="80px"
                                src="{{ asset('frontend/images/avatars/Avatar2.png') }}" alt=""></picture>
                        <div class="custom-file mt-4">
                            <input type="file" class="custom-file-input" id="profilePic" name="profilePic"
                                accept="image/*">
                            <label class="custom-file-label" for="screenshot">Browse your profile pic</label>
                        </div>
                        <span class="mt-2">OR</span>
                        <div class="header-text mt-2">Choose Avatar</div>
                    </div>
                    <div class="mx-3 pb-3" style="padding-top: 300px;">
                        <div class="row justify-content-between col-10 mx-auto">
                            <img height="50px" width="50px" src="{{ asset('frontend/images/avatars/Avatar1.png') }}"
                                alt="">
                            <img height="50px" width="50px" src="{{ asset('frontend/images/avatars/Avatar2.png') }}"
                                alt="">
                            <img height="50px" width="50px" src="{{ asset('frontend/images/avatars/Avatar3.png') }}"
                                alt="">
                            <img height="50px" width="50px" src="{{ asset('frontend/images/avatars/Avatar4.png') }}"
                                alt="">
                        </div>
                        <div class="row justify-content-between col-10 mx-auto mt-3">
                            <img height="50px" width="50px" src="/images/avatars/Avatar5.png" alt="">
                            <img height="50px" width="50px" src="{{ asset('frontend/images/avatars/Avatar6.png') }}"
                                alt="">
                            <img height="50px" width="50px" src="{{ asset('frontend/images/avatars/Avatar7.png') }}"
                                alt="">
                            <img height="50px" width="50px" src="{{ asset('frontend/images/avatars/Avatar8.png') }}"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="kyc-select">
            <div class="overlay" id="overlay_id" onclick="closeUpdateForm()"
                style="pointer-events: auto; opacity: 0.87;"></div>
            <div class="box kyc-select-enter-done" style="bottom: 0px; position: absolute;">
                <div class="bg-white">
                    <div class="header cxy flex-column">
                        <div class="header-text mt-2">Update Email</div>
                    </div>
                    <div class="mx-3 pb-3" style="padding-top: 130px;">
                        <form action="{{ url('user/update-email') }}" method="post">
                            @csrf
                            <div class="MuiFormControl-root MuiTextField-root d-flex m-auto w-80"><label
                                    class="MuiFormLabel-root MuiInputLabel-root MuiInputLabel-formControl MuiInputLabel-animated"
                                    data-shrink="false">Enter Email</label>
                                <div
                                    class="MuiInputBase-root MuiInput-root MuiInput-underline MuiInputBase-formControl MuiInput-formControl">
                                    <input aria-invalid="false" type="email" name="email"
                                        class="MuiInputBase-input MuiInput-input"
                                        value="@if (isset($user->email)) {{ $user->email }} @else @endif">
                                </div>
                            </div><button class="btn btn-success mt-3 text-uppercase d-flex mx-auto"
                                style="font-weight: 500;">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        function toggleEditSave() {
            var input = $('#vplayInput');
            var btn = $('#editSaveBtn');

            if (input.prop('readonly')) {
                // If input is readonly, make it editable and change button to Save
                input.prop('readonly', false);
                btn.text('Save');
                input.focus();
            } else {
                // If input is editable, make it readonly and change button to Edit
                saveVplayId(); // Add this line to save the value when changing to readonly mode.
                input.prop('readonly', true);
                btn.text('Edit');
            }
        }

    </script>

    <script>
        $('.vplay_new_id').hide();
        $('.new_profile_form').hide();

        function editVplayID() {
            $('.vplay_new_id').show();
            $('.vplay_id').empty();

        }

        function editImage() {
            $('.new_profile_form').show();
        }
    </script>

    <script>
        function saveVplayId() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: 'saveVplayID',
                type: 'post',
                data: {
                    'username': $('#vplayInput').val() // Use the ID selector instead of the class selector
                },
                success: function(data) {
                    if (data != 0) {
                        $('.vplay_new_id').hide();
                        $('.vplay_id').append(data.vplay_id +
                            '<img class="ml-2" width="20px" src="{{ asset('frontend/images/icon-edit.jpg') }}" alt="" onclick="editVplayID()">'
                        );
                    } else {
                        alert('Referral Code Not Updated!');
                    }
                },
                error: function() {
                    console.log('error');
                }
            });
        }



        function saveRefferBy() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //alert($('.refferalID').val());
            $.ajax({
                url: 'saveRefferBy',
                type: 'post',
                data: {
                    'refferalID': $('.refferalID').val()
                },
                success: function(data) {
                    // alert(data);
                    //console.log('success');
                    //console.log(data);
                    //console.log(data.referral_code);
                    if (data != 0) {
                        $('.refferForm').remove();
                        $('.MuiInputBase-root').append(data.reffered_by);

                    } else {
                        alert('User Name Not Updated!');
                    }
                },
                error: function() {
                    console.log('error');
                }
            });
        }
    </script>


    <script>
        $(document).ready(function() {
            $('.kyc-select').hide();
        });
    </script>
    <script>
        function showUpdateForm() {
            $('.kyc-select').show();
        }

        function closeUpdateForm() {
            $('.kyc-select').hide();
        }
    </script>
@endsection
