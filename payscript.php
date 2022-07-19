<?php 

$apiKey = "rzp_test_kravVdLw1x2hjv";

?>

<form action="" method="POST">
<script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo $apiKey; ?>" // Enter the Test API Key ID generated from Dashboard → Settings → API Keys
    data-amount="29935" // Amount is in currency subunits. Hence, 29935 refers to 29935 paise or ₹299.35.
    data-currency="INR"// You can accept international payments by changing the currency code. Contact our Support Team to enable International for your account
    data-order_id="<?php echo 'OID'.rand(10, 100).'END'  ?>"// Replace with the order_id generated by you in the backend.
    data-buttontext="Pay with Razorpay"
    data-name="Archan RD"
    data-description="A Fluids Arts selling website."
    data-image="https://user-images.githubusercontent.com/74826173/179001390-b088cff0-49ce-44cf-b03c-a15288c5e4dc.png"
    data-prefill.name=""
    data-prefill.email=""
    data-prefill.contact=""
    data-theme.color="#F37254"
></script>
<input type="hidden" custom="Hidden Element" name="hidden">
</form>