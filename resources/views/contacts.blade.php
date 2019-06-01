@extends('user.layout.app')

@section('content')
<style>
	body{
 
}
.contact-form{
    background: #fff;
    margin-top: 10%;
    margin-bottom: 5%;
    width: 70%;
}
.contact-form .form-control{
    border-radius:1rem;
}
.contact-image{
    text-align: center;
}
.contact-image img{
    border-radius: 6rem;
    width: 11%;
    margin-top: -3%;
    transform: rotate(29deg);
}
.contact-form form{
    padding: 14%;
}
.contact-form form .row{
    margin-bottom: -7%;
}
.contact-form h3{
    margin-bottom: 8%;
    margin-top: -10%;
    text-align: center;
    color: #0062cc;
}
.contact-form .btnContact {
    width: 50%;
    border: none;
    border-radius: 1rem;
    padding: 1.5%;
    background: #660066;
    font-weight: 600;
    color: #fff;
    cursor: pointer;
}
.btnContactSubmit
{
    width: 50%;
    border-radius: 1rem;
    padding: 1.5%;
    color: #fff;
    background-color: #0062cc;
    border: none;
    cursor: pointer;
}


</style>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
 
          <br><br><br><br>
            @include('includes.messages')
            <form method="post" action="{{ route('sendmail') }}">
            	{{csrf_field()}}
             <center>      <h3>Drop Us a Message</h3></center><br>
               <div class="row">
                <div class="col-lg-12"> 
                    <div class="col-lg-6 ">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Your Name *" value="" / required="">
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Your Email *" value="" / required="">
                        </div>
                        <div class="form-group">
                            <input type="number" name="mobile" class="form-control" placeholder="Your Phone Number *" value="" / required="">
                        </div>

                        <div class="form-group">
                            <textarea name="msg" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;" required=""></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="btnSubmit" class="btnContact" value="Send Message" />
                        </div>
                    </div>


                    <div class="col-lg-6">
                           <p>
            <h2> <b>Contact us: </b> </h2><br>

<b>Email:</b> info@swift-wheels.com    <br>  <br>
<b>Telephone:</b> (+233)302905777/500000422/500000423/246784202 <br>  <br>
<b>Location:</b> JohnTeyeU-Turn,WhiteHouseJunction(GW-0226-1850) <br>  <br>
<b>Address:</b> P.O.BoxWY931,Kwabenya. 
SocialMedia
 <br>  <br>
</p>
                    </div>

             

            </form>
   </div>
 
           
</div>
 
@endsection