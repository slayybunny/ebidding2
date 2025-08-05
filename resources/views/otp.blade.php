@if(session('success'))
    <div class="text-green-600">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="text-red-600">{{ $errors->first() }}</div>
@endif

<h2>OTP Emel</h2>
<form method="POST" action="{{ route('otp.email.send') }}">
    @csrf
    <input type="email" name="email" placeholder="Alamat Emel" required>
    <button type="submit">Hantar OTP Emel</button>
</form>

<form method="POST" action="{{ route('otp.email.verify') }}">
    @csrf
    <input type="email" name="email" placeholder="Alamat Emel" required>
    <input type="text" name="otp" placeholder="OTP" required>
    <button type="submit">Sahkan OTP Emel</button>
</form>

<h2>OTP SMS</h2>
<form method="POST" action="{{ route('otp.sms.send') }}">
    @csrf
    <input type="text" name="phone" placeholder="Nombor Telefon" required>
    <button type="submit">Hantar OTP SMS</button>
</form>

<form method="POST" action="{{ route('otp.sms.verify') }}">
    @csrf
    <input type="text" name="phone" placeholder="Nombor Telefon" required>
    <input type="text" name="otp" placeholder="OTP" required>
    <button type="submit">Sahkan OTP SMS</button>
</form>
