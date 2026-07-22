<?php
// Unique identifier for element matching
$form_uniq = uniqid('sf_');
?>
<form class="lead-short-form" action="<?php echo $root_prefix; ?>submit-booking.php" method="POST" style="background:#fff; border:1px solid #eee; border-radius:12px; padding:25px; box-shadow:0 4px 15px rgba(0,0,0,0.05); width:100%;">
    <div style="margin-bottom: 15px;">
        <label style="font-size:13px; font-weight:600; color:#333; margin-bottom:5px; display:block;">Full Name *</label>
        <input type="text" name="name" required placeholder="Enter your name" style="width:100%; padding:10px 15px; border:1px solid #ddd; border-radius:8px; font-size:14px; outline:none; height:45px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label style="font-size:13px; font-weight:600; color:#333; margin-bottom:5px; display:block;">Mobile Number *</label>
        <input type="tel" name="phone" required placeholder="Enter your 10-digit number" style="width:100%; padding:10px 15px; border:1px solid #ddd; border-radius:8px; font-size:14px; outline:none; height:45px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label style="font-size:13px; font-weight:600; color:#333; margin-bottom:5px; display:block;">Email Address *</label>
        <input type="email" name="email" required placeholder="Enter your email" style="width:100%; padding:10px 15px; border:1px solid #ddd; border-radius:8px; font-size:14px; outline:none; height:45px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label style="font-size:13px; font-weight:600; color:#333; margin-bottom:5px; display:block;">City *</label>
        <select name="city" required style="width:100%; padding:10px 15px; border:1px solid #ddd; border-radius:8px; font-size:14px; outline:none; background:#fff; height:45px;">
            <option value="" disabled selected>Select City</option>
            <option value="Hyderabad">Hyderabad</option>
            <option value="Bangalore">Bangalore</option>
            <option value="Mumbai">Mumbai</option>
            <option value="Pune">Pune</option>
            <option value="Chennai">Chennai</option>
            <option value="Delhi NCR">Delhi NCR</option>
            <option value="Ahmedabad">Ahmedabad</option>
            <option value="Other">Other</option>
        </select>
    </div>
    <div style="margin-bottom: 20px;">
        <label style="font-size:13px; font-weight:600; color:#333; margin-bottom:5px; display:block;">Service Required *</label>
        <select name="service" required style="width:100%; padding:10px 15px; border:1px solid #ddd; border-radius:8px; font-size:14px; outline:none; background:#fff; height:45px;">
            <option value="" disabled selected>Select a Service</option>
            <option value="Maid">Maid</option>
            <option value="Cook">Cook</option>
            <option value="Driver">Driver</option>
            <option value="Babysitter/Nanny">Babysitter/ Nanny</option>
            <option value="Elderly Care">Elderly Care</option>
            <option value="Watchman/Security Guard">Watchman/ Security Guard</option>
        </select>
    </div>
    
    <div style="display: flex; align-items: flex-start; gap: 8px; margin-bottom: 20px;">
        <input type="checkbox" name="premium_agreement" id="shortPremiumCheck_<?php echo $form_uniq; ?>" required style="margin-top: 4px;">
        <label for="shortPremiumCheck_<?php echo $form_uniq; ?>" style="font-size: 11px; color: #555; line-height: 1.4; margin-bottom: 0; cursor: pointer;">
            I understand that I have to pay a premium for domestic aid services with replacement support. *
        </label>
    </div>

    <button type="submit" style="width:100%; background:#ff890c; color:#fff; border:none; padding:12px; border-radius:8px; font-size:15px; font-weight:bold; cursor:pointer; transition:0.3s; height:45px;">Submit Details</button>
</form>
