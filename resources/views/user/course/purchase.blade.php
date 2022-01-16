@extends('app')
@section('content')

    @include('user.sections.nav')

    <div class="main-content">
        @include('user.sections.topSidebar')

        <div class="course-details pt-lg--5 pb-lg--5 pt-5 pb-5">
            <div class="container">
                <div class="card-body p-4 w-100 bg-current border-0 d-flex rounded-lg">
                    <h4 class="font-xs text-white fw-600 ml-4 mb-0 mt-2 w-100">دورة {{$course->title}} <span data-price = "{{$course->price}}" class="float-right">{{$course->price}} دينار أردني</span></h4>
                </div>
                <div class="col-lg-12 mt-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-3">
                                <div class="panel panel-default">
                                    <div class="panel-body">

                                        @if (Session::has('success'))
                                        <div class="alert alert-primary text-center">
                                            <p>{{ Session::get('success') }}</p>
                                        </div>
                                        @endif

                                        <h3>بوابة الدفع تجريبية فقط يمكنك استخدام رقم البطاقة التالي (4242424242424242)، وأي شيء آخر من البيانات بحيث تكون الشهر والسنة أكبر من الحالي</h3>

                                        <form role="form" action="{{ route('make-payment') }}" method="post" class="stripe-payment"
                                            data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                            id="stripe-payment">
                                            @csrf

                                            <input type="hidden" name="course_id" value="{{$course->id}}">
                                            <input type="hidden" name="amount" value="{{$course->price}}">
                                            <div class='form-row row'>
                                                <div class='col-md-4 form-group required'>
                                                    <label class='control-label'>اسم حامل البطاقة</label>
                                                     <input class='form-control'
                                                         type='text'>
                                                </div>
                                                <div class='col-md-4 form-group required'>
                                                    <label class='control-label'>رقم البطاقة</label>
                                                     <input autocomplete='off'
                                                        class='form-control card-num'  type='text'>
                                                </div>
                                            </div>

                                            <div class='form-row row'>
                                                <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                    <label class='control-label'>CVC</label>
                                                    <input autocomplete='off' class='form-control card-cvc' placeholder='e.g 595'
                                                        size='4' type='text'>
                                                </div>
                                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                    <label class='control-label'>شهر انتهاء الصلاحية</label> <input
                                                        class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                                </div>
                                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                    <label class='control-label'>سنة انتهاء الصلاحية</label> <input
                                                        class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                                                </div>
                                            </div>

                                            <div class='form-row row'>
                                                <div class='col-md-12 hide error form-group'>
                                                    <div class='alert-danger alert'>أصلح الأخطاء قبل أن تبدأ.</div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <button class="btn btn-success btn-lg btn-block" type="submit">اتمام عملية الشراء</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    $(function () {
        var $form = $(".stripe-payment");
        $('form.stripe-payment').bind('submit', function (e) {
            var $form = $(".stripe-payment"),
                inputVal = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputVal),
                $errorStatus = $form.find('div.error'),
                valid = true;
            $errorStatus.addClass('hide');

            $('.has-error').removeClass('has-error');
            $inputs.each(function (i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorStatus.removeClass('hide');
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey('pk_test_51HuylYEcUvyzDfScHSjANhZwB1jZgYNrImgxV3omjKe16xsv1RYvKlYqIA8VWqV1Bn2wIIOOXBxehuXAwdKU764z00ZwretnMY');
                Stripe.createToken({
                    number: $('.card-num').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeRes);
            }

        });

        function stripeRes(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

    });

</script>
@endsection
