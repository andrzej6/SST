{capture name='path'} 

Sample Form to generate PDF

{/capture}


<form action="/samplepdf" method="post">

   <div class="form-group">
           <label for="fname">{l s='(*) First Name'}</label>
                <input class="form-control validate" type="text" id="fname" name="fname" data-validate="isName" required />
                <div style="clear: both;"></div>
           </div>


          <div class="form-group">
          <label for="lname">{l s='(*) Last Name'}</label>
                <input class="form-control validate" type="text" id="lname" name="lname" data-validate="isName"  required />
                <div style="clear: both;"></div>
          </div>
		  
		  
		   <div class="submit form-group">
            <button type="submit" name="submitsimpleform" id="submitMessage" class="button-1 fill">{l s='Send'}</button>
		</div>


</form>