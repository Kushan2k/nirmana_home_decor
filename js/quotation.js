document.addEventListener('DOMContentLoaded',()=>{

    //insert ,update oparations
    let forms=document.querySelectorAll('.price-form');
    forms.forEach(form=>{
        form.addEventListener('submit',(e)=>{
            e.preventDefault();
            let qty=e.target.qty.value?e.target.qty.value:0;
            let sqft=e.target.sqft.value?parseFloat(e.target.sqft.value):0;
            let up=e.target.up.value?parseFloat(e.target.up.value):0;
            let totalbox=e.target.total;
            let pid=e.target.peaceid.value;
            let rid=e.target.refid.value;
            let date=e.target.date.value;




            let total=((sqft*up)*qty).toFixed(2);
            totalbox.value=total;

            if(!senddata(sqft,qty,up,total,date,pid,rid)){
                alert('Data Not Saved!');
            }
        });
    });

    //delete opration
    let delforms=document.querySelectorAll('.delete-form');
    delforms.forEach(form=>{
        form.addEventListener('submit',(e)=>{
            let ref=e.target.refid.value;
            if(!deleteDATA(ref)){
                alert('Could not delete Try again Later..');
            }
                    
        });
    });

    

    
});


function senddata(sqft,qty,price,total,date,pid,rid){
    let ajaxRequest;
    try{
        //opera,firefox,safari
        ajaxRequest=new XMLHttpRequest();
    }catch(e){
        try{
            ajaxRequest=new ActiveXObject('Msxm12.XMLHTTP');

        }catch(e){
            try{
                ajaxRequest=new ActiveXObject('Microsoft.XMLHTTP');
            }catch(e){
                return false;
            }
        }
    }
    ajaxRequest.onreadystatechange=()=>{
        if(ajaxRequest.readyState==4){
            if(ajaxRequest.responseText){
                alert(ajaxRequest.responseText);
                return true;
            }else{
                return false;
            }
            
        }

    }
    /*
        $lcation=$_GET['location'];
        $code=$_GET['code'];
        $pn=$_GET['pname'];
        $unit=$_GET['sf'];
        $qty=$_GET['qty'];
        $price=$_GET['price'];
        $total=$_GET['total'];
        */
    let query=`saveQuo.php?peaceid=${pid}&refid=${rid}&date=${date}&sqft=${sqft}&qty=${qty}&price=${price}&total=${total}`;
    ajaxRequest.open('GET',query,true);
    ajaxRequest.send();
    return true;



}

function deleteDATA(rid){
    let ajaxRequest;
    try{
        //opera,firefox,safari
        ajaxRequest=new XMLHttpRequest();
    }catch(e){
        try{
            ajaxRequest=new ActiveXObject('Msxm12.XMLHTTP');

        }catch(e){
            try{
                ajaxRequest=new ActiveXObject('Microsoft.XMLHTTP');
            }catch(e){
                return false;
            }
        }
    }
    ajaxRequest.onreadystatechange=()=>{
        if(ajaxRequest.readyState==4){
            if(ajaxRequest.responseText){
                alert(ajaxRequest.responseText);
                return true;
            }else{
                return false;
            }
            
        }

    }
    /*
        $lcation=$_GET['location'];
        $code=$_GET['code'];
        $pn=$_GET['pname'];
        $unit=$_GET['sf'];
        $qty=$_GET['qty'];
        $price=$_GET['price'];
        $total=$_GET['total'];
        */
    let query=`saveQuo.php?refid=${rid}&del=${true}`;
    ajaxRequest.open('GET',query,true);
    ajaxRequest.send();
    return true;
}