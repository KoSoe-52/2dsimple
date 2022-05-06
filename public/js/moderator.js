//assign selected number
var selectedNumbers =[];
//same digit 
var sameDigit = ["00","11","22","33","44","55","66","77","88","99"];
//power digit
var powerDigit = ["05","16","27","38","49"];
//nagkhat digit 
var nagkhatDigit =["07","18","24","35","69"];
//nyi ko digit 
var nyikoDigit =["01","12","23","34","45","56","67","78","89","90"]; 
//sone sone
var soneSone = ["00","02","04","06","08","20","22","24","26","28","40","42","44","46","48","60","62","64","66","68","80","82","84","86","88"];
//soneMa 
var soneMa =["01","03","05","07","09","21","23","25","27","29","41","43","45","47","49","61","63","65","67","69","81","83","85","87","89"];
//var maSone
var maSone = ["10","12","14","16","18","30","32","34","36","38","50","52","54","56","58","70","72","74","76","78","90","92","94","96","98"];
//var maMa
var maMa = ["11","13","15","17","19","31","33","35","37","39","51","53","55","57","59","71","73","75","77","79","91","93","95","97","99"];
$(document).ready(function(){
    $(".button span").click(function(){
        $(this).toggleClass("selectedColor");
        var clickedNumber = $(this).text();
        /*
        * check selected number is already existed or not
        */
        if(selectedNumbers.includes(clickedNumber))
        {
            var index = selectedNumbers.indexOf(clickedNumber); // get index if value found otherwise -1
            if (index > -1) { //if found
              selectedNumbers.splice(index, 1);
            }
        }else
        {
            selectedNumbers.push($(this).text());
        }
        //ထိုးမည် button အား color change ခြင်း
        selectedNumberCheck(selectedNumbers);
        console.log(selectedNumbers);
    });
    //ထိုးမည် button
    $(document).on("click",".lucky-btn",function(){
        $("#luckyList").modal("show");
        var amount = $("#amount").val();
        var total = [];
        selectedNumbers.sort();
        var html="<table class='table mt-0'><tr><th>ထိုးဂဏန်း</th><th style='text-align:center'>ငွေပမာဏ</th><th style='text-align:center'>ဖျက်</th></tr>";
        for(var i=0;i<selectedNumbers.length;i++)
        {
            total[i]=amount;
            html+="<tr>"+
                    "<td style='text-align:left'><span class='rounded-circle bg-success p-2 text-white twod-number'>"+selectedNumbers[i]+"</span></td>"+
                    "<td style='width:30%;text-align:center'><input type='number' value='"+amount+"' class='amount' style='width:80px'></td>"+
                    "<td style='text-align:right'><span class='btn btn-danger pt-1 pb-1 fs-6 fw-normal remove'>ပယ်မည်</span></td>"+
                 "</tr>";
        }
        html+="<tr><td>ထိုးငွေစုစုပေါင်း</td><td colspan='2' class='fw-bold total align-center'>"+eval(total.join('+'))+"</td></tr>";
        html+="</table>";
        $(".lucky-list").html(html);
    });
    $(document).on("keyup",".amount",function(){
        //collect amount data into totalArray
        var totalArray=calculateTotal();
        //replace the sum of array inside of the total class
        $(".total").text(eval(totalArray.join('+')));
    });
    $(document).on("click",".remove",function(){
        //get removed button twod-number
        var removedTwodNumber = $(this).parent().parent().find(".twod-number").text();
        //remove tr row
        $(this).parent().parent().remove();
        //remove clicked number in the selectedNumbers
        var index = selectedNumbers.indexOf(removedTwodNumber); // get index if value found otherwise -1
        if (index > -1) { //if found
          selectedNumbers.splice(index, 1);
        }
        //toggleClass to change background-color
        $("."+removedTwodNumber).toggleClass("selectedColor");
        //collect amount data into totalArray
        var totalArray=calculateTotal();
        //replace the sum of array inside of the total class
        $(".total").text(eval(totalArray.join('+')));
        console.log(selectedNumbers);
    });
    $(document).on("click",".group1",function()
    {
        var groupName = $(this).attr("id");
        if(groupName == "sameDigit")
        {
            for(var i=0; i< sameDigit.length; i++)
            {
                //color changed
                $("."+sameDigit[i]).addClass("selectedColor");
                /*
                * check selected number is already existed or not
                */
                if(selectedNumbers.includes(sameDigit[i]))
                {
                    //already selected
                }else
                {
                    //push to selectedNumbers
                    selectedNumbers.push(sameDigit[i]);
                }
                $("#fast-choose-modal").modal("hide");
            }
        }else if( groupName == "powerDigit")
        {
            for(var i=0; i< powerDigit.length; i++)
            {
                //color changed
                $("."+powerDigit[i]).addClass("selectedColor");
                /*
                * check selected number is already existed or not
                */
                if(selectedNumbers.includes(powerDigit[i]))
                {
                    //already selected
                }else
                {
                    //push to selectedNumbers
                    selectedNumbers.push(powerDigit[i]);
                }
                $("#fast-choose-modal").modal("hide");
            }
        }else if(groupName == "nagkhatDigit")
        {
            for(var i=0; i< nagkhatDigit.length; i++)
            {
                //color changed
                $("."+nagkhatDigit[i]).addClass("selectedColor");
                /*
                * check selected number is already existed or not
                */
                if(selectedNumbers.includes(nagkhatDigit[i]))
                {
                    //already selected
                }else
                {
                    //push to selectedNumbers
                    selectedNumbers.push(nagkhatDigit[i]);
                }
                $("#fast-choose-modal").modal("hide");
            }
        }else if(groupName == "nyikoDigit")
        {
            for(var i=0; i< nyikoDigit.length; i++)
            {
                //color changed
                $("."+nyikoDigit[i]).addClass("selectedColor");
                /*
                * check selected number is already existed or not
                */
                if(selectedNumbers.includes(nyikoDigit[i]))
                {
                    //already selected
                }else
                {
                    //push to selectedNumbers
                    selectedNumbers.push(nyikoDigit[i]);
                }
                $("#fast-choose-modal").modal("hide");
            }
        }else if(groupName == "soneSone")
        {
            for(var i=0; i< soneSone.length; i++)
            {
                //color changed
                $("."+soneSone[i]).addClass("selectedColor");
                /*
                * check selected number is already existed or not
                */
                if(selectedNumbers.includes(soneSone[i]))
                {
                    //already selected
                }else
                {
                    //push to selectedNumbers
                    selectedNumbers.push(soneSone[i]);
                }
                $("#fast-choose-modal").modal("hide");
            }
        }else if(groupName == "soneMa")
        {
            for(var i=0; i< soneMa.length; i++)
            {
                //color changed
                $("."+soneMa[i]).addClass("selectedColor");
                /*
                * check selected number is already existed or not
                */
                if(selectedNumbers.includes(soneMa[i]))
                {
                    //already selected
                }else
                {
                    //push to selectedNumbers
                    selectedNumbers.push(soneMa[i]);
                }
                $("#fast-choose-modal").modal("hide");
            }
        }else if(groupName == "maMa")
        {
            for(var i=0; i< maMa.length; i++)
            {
                //color changed
                $("."+maMa[i]).addClass("selectedColor");
                /*
                * check selected number is already existed or not
                */
                if(selectedNumbers.includes(maMa[i]))
                {
                    //already selected
                }else
                {
                    //push to selectedNumbers
                    selectedNumbers.push(maMa[i]);
                }
                $("#fast-choose-modal").modal("hide");
            }
        }else if(groupName == "maSone")
        {
            for(var i=0; i< maSone.length; i++)
            {
                //color changed
                $("."+maSone[i]).addClass("selectedColor");
                /*
                * check selected number is already existed or not
                */
                if(selectedNumbers.includes(maSone[i]))
                {
                    //already selected
                }else
                {
                    //push to selectedNumbers
                    selectedNumbers.push(maSone[i]);
                }
                $("#fast-choose-modal").modal("hide");
            }
        }
        //ထိုးမည် button အား color change ခြင်း
        selectedNumberCheck(selectedNumbers);
        console.log(selectedNumbers);
    });//group 1
    $(document).on("click",".group2",function()
    {
        var groupName = $(this).attr("id");
        var number = $(this).text();
        if(groupName == "front")
        {
            for(var i=0; i< 10; i++)
            {
                //color changed
                $("."+number+i).addClass("selectedColor");
                /*
                * check selected number is already existed or not
                */
                if(selectedNumbers.includes(number+i))
                {
                    //already selected
                }else
                {
                    //push to selectedNumbers
                    selectedNumbers.push(number+i);
                }
            }
        }else if(groupName == "back")
        {
            for(var i=0; i< 10; i++)
            {
                //color changed
                $("."+i+number).addClass("selectedColor");
                /*
                * check selected number is already existed or not
                */
                if(selectedNumbers.includes(i+number))
                {
                    //already selected
                }else
                {
                    //push to selectedNumbers
                    selectedNumbers.push(i+number);
                }
            }
        }
        $("#fast-choose-modal").modal("hide");
        //ထိုးမည် button အား color change ခြင်း
        selectedNumberCheck(selectedNumbers);
        console.log(selectedNumbers);
    });//group2
    $(document).on("click",".group3",function()
    {
        var groupName = $(this).attr("id");
        var number = $(this).text();
        if(groupName == "pad")
        {
            for(var i=0; i< 10; i++)
            {
                //color changed
                $("."+number+i).addClass("selectedColor");
                $("."+i+number).addClass("selectedColor");
                /*
                * check selected number is already existed or not
                */
                if(selectedNumbers.includes(number+i))
                {
                    //already selected
                }else
                {
                    //push to selectedNumbers
                    selectedNumbers.push(number+i);
                }
                if(selectedNumbers.includes(i+number))
                {
                    //already selected
                }else
                {
                    //push to selectedNumbers
                    selectedNumbers.push(i+number);
                }
            }
        }
        $("#fast-choose-modal").modal("hide");
        //ထိုးမည် button အား color change ခြင်း
        selectedNumberCheck(selectedNumbers);
        console.log(selectedNumbers);
    });//group 3
    $(document).on("click",".r",function()
    {
        for(var i=0; i< selectedNumbers.length;i++)
        {
            //console.log(selectedNumbers[i]);
            let number = selectedNumbers[i];//01
            let reverseNumber = number[1]+number[0];
            if(selectedNumbers.includes(reverseNumber))
            {
                //already selected
            }else
            {
                //push to selectedNumbers
                selectedNumbers.push(reverseNumber);
                $("."+reverseNumber).addClass("selectedColor");
            }
        }
        console.log(selectedNumbers);
    });
    $(document).on("click",".khawe-btn",function(){
        var digits = $("#khawe").val();
        for (var i = 0; i < digits.length; i++) {
            //console.log(digits.charAt(i));
            let loopDigit = digits.charAt(i);
            for(var ii=0; ii< digits.length; ii++)
            {
                if(digits.charAt(ii) != loopDigit)
                {
                    let resultDigit = loopDigit+digits.charAt(ii);
                    //check exist
                    if(selectedNumbers.includes(resultDigit))
                    {
                    }else
                    {
                        //push to global array
                        selectedNumbers.push(resultDigit);
                        $("."+resultDigit).addClass("selectedColor");
                    }
                }
            }
        }
        $("#fast-choose-modal").modal("hide");
        //ထိုးမည် button အား color change ခြင်း
        selectedNumberCheck(selectedNumbers);
        console.log(selectedNumbers.sort());
    });
});
function calculateTotal()
{
    var total =[];
    $(".amount").each(function(index){
        if($(this).val() == "")
        {
            total[index]= 0;
        }else
        {
            total[index]=$(this).val();
        }
    });
    return total;
}

/*
* check two d number is selected or not 
*/
function selectedNumberCheck(array)
{
    if(array.length > 0)
    {
        $(".lucky-btn").addClass("lucky-btn-selected");
    }else
    {
        $(".lucky-btn").removeClass("lucky-btn-selected");
    }
}
setInterval(() => {
    var randomColor = Math.floor(Math.random()*16777215).toString(16);
    document.querySelector('meta[name="theme-color"]').setAttribute("content", "#"+randomColor);
}, 2000);