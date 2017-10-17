<h2>Create your new plan!</h2>
<hr class='style-five'>
      Enter your details and preferences:<br>
      <form method='POST' action='profile.php' id='user_category'>
      Age: <br><input type='text' id='user_age' name='age'><br>
      Height: <br><input type='text' id='user_height' name='Height'><br>
      Weight: <br><input type='text' id='user_weight' name='Weight'><br>
      How active are you?
      <br>
      <br>
      <input type="range" id="user_activity" min="0" max="4" value="2" step="1" name='activity' onchange="showValue(this.value)" />
      <br>
      <span id="range">Moderate activity (3 to 5 days a weeks)</span>
      <script type='text/javascript'>
        function showValue(newValue){
        var text='';
        switch (newValue) {
          case "0": text='Little to no activity';
            break;
          case "1": text='Light activity (1 to 3 days a week)';
            break;
          case "2": text='Moderate activity (3 to 5 days a weeks)';
            break;
          case "3": text='Heavy activity (6 to 7 days a week)';
            break;
          case "4": text='Very heavy activity (Twice a day or more)';
            break;
          default:  text='Moderate activity (3 to 5 days a weeks)';
        }
          document.getElementById("range").innerHTML = text;

      }
      </script>
      <h3 id='goals'> Goals</h3>
      Choose what type of exercise you want:
      <select class='selector' name='goals' id='ex_type'>
        <option value='1'>Weight Loss</option>
        <option value='2'>Muscle Gain</option>
      </select><br>
      <input type='hidden' name='category' id='category' data-value=''>
      <input type='button' id='submit' value='Submit' class='button_1' >
      </form>

      <script>
          $(document).ready(function(){
            $('#submit').click(function(){
              var age;
              var age_class;
              var height;
              var weight;
              var activity_type;
              var bmi;
              var bmi_class;
              var ex_type;
              var category;

              age = document.getElementById('user_age').value;
              activity_type= document.getElementById('user_activity').value;
              height = document.getElementById('user_height').value;
              weight = document.getElementById('user_weight').value;
              ex_type = document.getElementById('ex_type').value;
              category=document.getElementById('category');
              bmi = weight*0.45/(height*height*0.000625);


              if(bmi< 16){
                bmi_class='1';
              }
              else if (bmi<18.5) {
                bmi_class='2';
              }
              else if (bmi<25) {
                bmi_class='3';
              }
              else if(bmi<30){
                bmi_class='4';
              }
              else{
                bmi_class='5';
              }

              if(age<30){
                age_class='1';
              }
              else if (age<50) {
                age_class='2';
              }
              else if (age<70) {
                age_class='3';
              }
              else{
                age_class='4';
              }
              category.value = bmi_class+ex_type+age_class+activity_type;
              if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
              }
              xmlhttp.open("GET", "ajax.php?cat=" + category.value +"&age="+age+"&height="+height+"&weight="+weight, true);
              xmlhttp.onload = function () {
                if (xmlhttp.readyState === xmlhttp.DONE) {
                  if (xmlhttp.status === 200) {
                    console.log(xmlhttp.response);
                    console.log(xmlhttp.responseText);
                  }
                }
              };
              xmlhttp.send();
              location.reload();
          });
          });

      </script>
