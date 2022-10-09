# parsianPay
Easily integrate PHP application with parsian bank payment.

# Installation
``` bash
$ composer require mastercode724/parsian-ipg
```

# Example Usage
# Example For Pay

``` bash
use Mastercode724\ParsianIPG\ParsianIPG;
use Mastercode724\ParsianIPG\Entities\SalePaymentResult;

$parsianIPG=new ParsianIPG('scsdsdfbdsthsgfnfgndg');//set parsian pin
$OrderId = (float)(time() . rand(000,999)); // factor number
$Amount  = 1000; // amount to pay
$CallbackUrl='http://example.ir/callback' ; // set callback url
$additionalData='' ; // set Additional Data max 500 character
$originator='' ; // set Originator max 50 character
$isLog=true; //is log request and result
$addressLogger="";//is log file address request and result
$salePaymentResult=$parsianIPG->salePayment($OrderId,$Amount,$CallbackUrl,$additionalData,$originator,$isLog,$addressLogger);
if($parsianIPG->isReadyToRedirect($salePaymentResult)){
    $parsianIPG->redirect($salePaymentResult);// redirect to parsian bank gateway  for payment  
}


 
```

# Example For Callback
``` bash
use Mastercode724\ParsianIPG\ParsianIPG;
use Mastercode724\ParsianIPG\Entities\ConfirmPaymentResult;
  
$parsianIPG=new ParsianIPG('scsdsdfbdsthsgfnfgndg');//set parsian pin 
$isLog=true; //is log request and result
$addressLogger="";//is log file address request and result
$confirmPaymentResult = $parsianIPG->confirmPayment($isLog,$addressLogger);
if($parsianIPG->isReadyConfirm($confirmPaymentResult)){
    die(' Payment OK '); 
}else{
    if($confirmPaymentResult instanceof ConfirmPaymentResult){ 
        echo $confirmPaymentResult->getMessage();
    }
} 





```


# Example For reverse
``` bash
use Mastercode724\ParsianIPG\ParsianIPG;
use Mastercode724\ParsianIPG\Entities\ReversalResult;

$parsianIPG=new ParsianIPG('scsdsdfbdsthsgfnfgndg');//set parsian pin 
$isLog=true; //is log request and result
$addressLogger="";//is log file address request and result
$reversalResult = $parsianIPG->reversal(12545485,$isLog,$addressLogger);//reverse token payment
if($parsianIPG->isReadyReversal($reversalResult)){
    die(' Reverse Payment OK '); 
}else{
    if($reversalResult instanceof ReversalResult){ 
        echo $reversalResult->getMessage();
    }
}



```

جهت صدا زدن درگاه پرداخت #
``` bash
use Mastercode724\ParsianIPG\ParsianIPG;
use Mastercode724\ParsianIPG\Entities\SalePaymentResult;

# ایجاد کلاس درگاه . ورودی سازنده کلاس . Loginaccount درگاه می باشد
$parsianIPG=new ParsianIPG('scsdsdfbdsthsgfnfgndg');//set parsian pin
# ورودی ها
$OrderId = آی دی یکتای پرداخت; // factor number
$Amount  = مبلغ پرداختی ; // amount to pay
$CallbackUrl=آدرس بازگشتی به سایت ; // set callback url
$additionalData= رشته با طول حداکثر 500 کاراکتر حاوی داده های اضافی است   ; // set Additional Data max 500 character
$originator=  رشته با طول حداکثر 50 کاراکتر که نمایانگر منشأ درخواست تراکنش میباشد ; // set Originator max 50 character
$isLog = فلگ تعیین وضعیت لاگ  ; //is log request and result
در صورتی که این فلگ مقدار true داشته باشد . اطلاعات درخواست و خروجی فرخوانی در فایل لاگ ثبت می شود
$addressLogger= آدرس   فایل لاگ ;//is log file address request and result
در صورتی که شما آدرس فایل لاگ را مقداردهی نکنید فایل لاگ در مسیر کد پکیج در پوشه logs قرار داده می شود 

# فراخوانی تابع salePayment برای درگاه پرداخت   
$salePaymentResult=$parsianIPG->salePayment($OrderId,$Amount,$CallbackUrl,$additionalData,$originator,$isLog,$addressLogger);
# چک کردن نتیجه فراخوانی    
در صورتی که خروجی در وضعیت موفق باشد تابع isReadyToRedirect  نتیجه درستی true را برمی گرداند در غیر اینصورت نتیجه false را بر می گرداند

if($parsianIPG->isReadyToRedirect($salePaymentResult)){
# انتقال به صفحه پرداخت    

    $parsianIPG->redirect($salePaymentResult);// redirect to parsian bank gateway  for payment  
}


 
```
