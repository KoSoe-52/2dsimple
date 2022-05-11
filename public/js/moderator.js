
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
    $(".button .number").click(function(){
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
            selectedNumbers.push({remaining:$(this).data("id"),number:$(this).text()});
        }
        //ထိုးမည် button အား color change ခြင်း
        selectedNumberCheck(selectedNumbers);
        console.log(selectedNumbers);
    });
    //ထိုးမည် button
    $(document).on("click",".lucky-btn",function(){
        $("#luckyList").modal("show");
        var amount = $("#amount").val();
        if(amount =="")
        {
            var html="<center class='text-danger mt-5'>ထိုးငွေအနည်းဆုံး(၅၀)ကျပ်ထည့်သွင်းပါ</center>";
            $(".lucky-list").html(html);
        }else
        {
            var total = [];
            selectedNumbers.sort();
            var html='<div class="spinner-border loader text-info z-index-n1 position-fixed top-50 start-50 d-none"></div>';
            html+="<table class='table mt-0'><tr><th>ဂဏန်း</th><th style='text-align:center'>ခွင့်ပြုငွေ</th><th style='text-align:center'>ထိုးငွေ</th><th style='text-align:center'>ဖျက်</th></tr>";
            for(var i=0;i<selectedNumbers.length;i++)
            {
                total[i]=amount;
                html+="<tr>"+
                        "<td style='text-align:left'><span class='rounded-circle bg-success p-2 text-white twod-number'>"+selectedNumbers[i]["number"]+"</span><input type='hidden' name='number[]' value='"+selectedNumbers[i]["number"]+"'></td>"+
                        "<td style='width:25%;text-align:center'>"+selectedNumbers[i]["remaining"]+"</td>"+
                        "<td style='width:20%;text-align:center'><input type='number' value='"+amount+"' name='amount[]' max='"+selectedNumbers[i]["remaining"]+"' class='amount' style='width:80px'></td>"+
                        "<td style='text-align:right'><span class='btn btn-danger pt-1 pb-1 fs-6 fw-normal remove fa fa-trash'></span></td>"+
                    "</tr>";
            }
            html+="<tr><td colspan='2'>ထိုးငွေစုစုပေါင်း</td><td colspan='2' class='fw-bold total align-center'>"+eval(total.join('+'))+"</td></tr>";
            html+="</table>";
            html+="<label for=''>ထီထိုးသူ </label><input type='text' name='name' autocomplete='off' required style='padding:7px;border:1px solid #ddd;width:100%;margin-top:4px;'>";
            $(".lucky-list").html(html);
        }
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
                    var classDigit= $(".number").hasClass(sameDigit[i]);
                    if(classDigit == true)
                    {
                        var remaining =$("."+sameDigit[i]).data("id");
                        selectedNumbers.push({remaining:remaining,number:sameDigit[i]});
                    }
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
                    var classDigit= $(".number").hasClass(powerDigit[i]);
                    if(classDigit == true)
                    {
                        var remaining =$("."+powerDigit[i]).data("id");
                        selectedNumbers.push({remaining:remaining,number:powerDigit[i]});
                    }
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
                    var classDigit= $(".number").hasClass(nagkhatDigit[i]);
                    if(classDigit == true)
                    {
                        var remaining =$("."+nagkhatDigit[i]).data("id");
                        selectedNumbers.push({remaining:remaining,number:nagkhatDigit[i]});
                    }
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
                    var classDigit= $(".number").hasClass(nyikoDigit[i]);
                    if(classDigit == true)
                    {
                        var remaining =$("."+nyikoDigit[i]).data("id");
                        selectedNumbers.push({remaining:remaining,number:nyikoDigit[i]});
                    }
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
                    var classDigit= $(".number").hasClass(soneSone[i]);
                    if(classDigit == true)
                    {
                        var remaining =$("."+soneSone[i]).data("id");
                        selectedNumbers.push({remaining:remaining,number:soneSone[i]});
                    }
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
                    var classDigit= $(".number").hasClass(soneMa[i]);
                    if(classDigit == true)
                    {
                        var remaining =$("."+soneMa[i]).data("id");
                        selectedNumbers.push({remaining:remaining,number:soneMa[i]});
                    }
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
                    var classDigit= $(".number").hasClass(maMa[i]);
                    if(classDigit == true)
                    {
                        var remaining =$("."+maMa[i]).data("id");
                        selectedNumbers.push({remaining:remaining,number:maMa[i]});
                    }
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
                    var classDigit= $(".number").hasClass(maSone[i]);
                    if(classDigit == true)
                    {
                        var remaining =$("."+maSone[i]).data("id");
                        selectedNumbers.push({remaining:remaining,number:maSone[i]});
                    }
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
                    var classDigit= $(".number").hasClass(number+i);
                    if(classDigit == true)
                    {
                        var remaining =$("."+number+i).data("id");
                        selectedNumbers.push({remaining:remaining,number:number+i});
                    }
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
                    var classDigit= $(".number").hasClass(i+number);
                    if(classDigit == true)
                    {
                        var remaining =$("."+i+number).data("id");
                        selectedNumbers.push({remaining:remaining,number:i+number});
                    }
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
                /*
                * check selected number is already existed or not
                */
                if(selectedNumbers.includes(number+i))
                {
                    //already selected
                }else
                {
                    //push to selectedNumbers
                    var classDigit= $(".number").hasClass(number+i);
                    if(classDigit == true)
                    {
                        var remaining =$("."+number+i).data("id");
                        selectedNumbers.push({remaining:remaining,number:number+i});
                        //color changed
                        $("."+number+i).addClass("selectedColor");
                    }
                }
                let findNum =i+number;
                if(selectedNumbers.includes(findNum))
                {
                    //already selected
                }else
                {
                    if(i+number == number+number)
                    {}else
                    {
                       //push to selectedNumbers
                        var classDigit= $(".number").hasClass(i+number);
                        if(classDigit == true)
                        {
                            var remaining =$("."+i+number).data("id");
                            selectedNumbers.push({remaining:remaining,number:i+number});
                            $("."+i+number).addClass("selectedColor");
                        }     
                    }
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
                var classDigit= $(".number").hasClass(reverseNumber);
                if(classDigit == true)
                {
                    //push to selectedNumbers
                    var remaining =$("."+reverseNumber).data("id");
                    selectedNumbers.push({remaining:remaining,number:reverseNumber});
                    $("."+reverseNumber).addClass("selectedColor");
                }
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
                        var classDigit= $(".number").hasClass(resultDigit);
                        if(classDigit == true)
                        {
                            var remaining =$("."+resultDigit).data("id");
                            selectedNumbers.push({remaining:remaining,number:resultDigit});
                            $("."+resultDigit).addClass("selectedColor");
                        }
                    }
                }
            }
        }
        $("#fast-choose-modal").modal("hide");
        //ထိုးမည် button အား color change ခြင်း
        selectedNumberCheck(selectedNumbers);
        console.log(selectedNumbers.sort());
    });
   
});//end ready
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