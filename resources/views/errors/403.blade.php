<section class="content">
    <center><h1 class="headline text-yellow"> 403</h1></center>
    <center><h1 class="headline text-yellow">  Oops! Forbidden Page .</h1></center>
    <center><h3 class="headline text-yellow"><a href="{{url('/home')}}">back to home</a></h3></center>
</section>
<script type="text/JavaScript">
	redirectURL = "{{url('/home')}}";
	setTimeout("location.href = redirectURL;", 5000);
</script>
