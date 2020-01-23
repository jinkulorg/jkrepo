var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var y;
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) 
  {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } 
  else if (n == (x.length - 2))
  {
    // document.getElementById("nextBtn").innerHTML = "Review";
    document.getElementById("nextBtn").innerHTML = "Next";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }

  /*var tabs = document.getElementsByClassName('tab');
  if(n == (tabs.length-1))
  {
      var firstTabInputs = tabs[0].getElementsByTagName('input');
      var lastTabInputs = tabs[4].getElementsByTagName('input');
      lastTabInputs[0].value = firstTabInputs[1].value;
      lastTabInputs[1].value = firstTabInputs[2].value;
  }
*/
  var x = document.getElementsByClassName('tab');
  if(n == (x.length-1))
  {
    //FirstTab 
    // var inputTags = x[0].getElementsByTagName("input");
    // document.getElementById("profilepicDiv").innerHTML = inputTags[0].value; 
    // document.getElementById("firstnameDiv").innerHTML = inputTags[1].value;
               
    // var selecttags = x[0].getElementsByTagName("select");
    // document.getElementById("genderDiv").innerHTML = selecttags[0].value;
    
    // try {
    //   i=0;
    //   var reviewDivs = document.getElementsByClassName("reviewInput");
    //   for(j=0;j<=x.length-2;j++)
    //   {

    //     dataInputTags = x[j].getElementsByTagName("input");
        
    //     for(k=0;k<=dataInputTags.length-1;k++)
    //     {
    //       reviewDivs[i].innerHTML = dataInputTags[k].value;
    //       i++; 
    //       if(i==2)
    //       {
    //           break;
    //       }
    //     }
    //     break;
    //   }
    // }
    // catch(err) {
    //   document.getElementById("demo").innerHTML = document.getElementById("demo").innerHTML.concat(err.message);
    // }


   }

  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {

  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
 if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:

  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("profileForm").submit();
    return false;
  }

  var navitems = document.getElementsByClassName("nav-item");
  if(n == 1)
  {
    //Next
    var atags = navitems[currentTab-1].getElementsByTagName("a");
  }
  else
  { 
    //Previous
    var atags = navitems[currentTab+1].getElementsByTagName("a"); 
  }
  atags[0].className = atags[0].className.replace("nav-link active_tab1", "nav-link inactive_tab1");
  atags = navitems[currentTab].getElementsByTagName("a");
  atags[0].className = atags[0].className.replace("nav-link inactive_tab1", "nav-link active_tab1");

  // Otherwise, display the correct tab:
  showTab(currentTab);


  
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, j, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  var textAreas = x[currentTab].getElementsByTagName("textarea");
  var selects = x[currentTab].getElementsByTagName("select");

  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].type == "radio") {
      radioOptions = document.getElementsByName(y[i].name);
      var checked = false;
      for(j=0 ; j < radioOptions.length ; j++) {
        if (radioOptions[j].checked == true) {
          checked = true;
          break;
        } 
      }
      if (checked == false) {
        for(j=0 ; j < radioOptions.length ; j++) {
          var spanId = "span" + radioOptions[j].name + radioOptions[j].value;
          span = document.getElementById(spanId);
          span.className = "checkmark";
        }
        valid = false;
      }
    } else if (y[i].value == "") {
      if (y[i].className.trim().includes('optional valid') == false) {
        // add an "invalid" class to the field:
        y[i].className += " invaliddata";
        // and set the current valid status to false:
        valid = false;
      }
    }
  }

  for (i = 0; i < textAreas.length; i++) {
    // If a field is empty...
    if (textAreas[i].value == "") {
      // add an "invalid" class to the field:
      textAreas[i].className += " invaliddata";
      // and set the current valid status to false:
      valid = false;
      
    }
  }
  
  for (i = 0; i < selects.length; i++) {
    // If a field is empty...
    if (selects[i].value == "") {
      // add an "invalid" class to the field:
      selects[i].className += " invaliddata";
      // and set the current valid status to false:
      valid = false;
      
    }
  }

  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
 
}