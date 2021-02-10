document.addEventListener('DOMContentLoaded',()=>{
    //color code
    let disform=document.getElementById('discountform');
        disform.addEventListener('submit',(e)=>{
            e.preventDefault();
            if(setdiscount(e.target.ref.value,e.target.discount.value)){
                alert('Discount Has been set!');
                e.target.remove();
            }else{
                alert('Can not set discount!')
            }
        })

    let del=document.querySelectorAll('.deletebtn');
    del.forEach(d=>{
        d.addEventListener('click',(e)=>{
            e.target.parentElement.parentElement.remove();
        })
    })




    function setdiscount(refid,discount){
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
                        return true;
                    }else{
                        return false;
                    }
                    
                }

            }
            let query=`done.php?ref=${refid}&discount=${discount}`;
            ajaxRequest.open('GET',query,true);
            ajaxRequest.send();
            return true;



    }

    
    
    
    let forms=document.querySelectorAll('.cortation-form');
    forms.forEach(form=>{
        form.addEventListener('submit',(e)=>{
            e.preventDefault();
            let pn=e.target.pname.value;
            let code=e.target.code.value?e.target.code.value:'N/A';
            let location=e.target.location.value;
            let sfeet=checkSF(e.target.sf.value);
            let price=checkprice(e.target.price.value);
            let qty=checkQT(e.target.qty.value);

            let totalshow=e.target.total;

                
            let p=((sfeet*price)*qty).toFixed(2);

            totalshow.value='LKR. '+p;
            if(senddata(pn,location,code,sfeet,qty,price,p)){
                alert('Insert SuccessFull!');
                e.target.save.style.display='none';
                //e.target.parentElement.remove();
                
                
            }else{
                alert('Insert Faild !');
            }

            

            

        });
    });
    


    function checkprice(price=0){
        if(price){
            if(parseFloat(price)){
                return price;
            }else{
                return false;
            }
        }else{
            return 0;
        }
    }
    function checkSF(sq=0){
        if(sq){
            if(parseFloat(sq)){
                return sq;
            }else{
                return false;
            }
        }else{
            return 0;
        }
    }
    function checkQT(qt=0){
        if(qt){
            if(parseInt(qt)){
                return qt;
            }else{
                return false;
            }
        }else{
            return 0;
        }
    }

    function senddata(pn,location,cc='N/A',unit,qty,price,total){
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
        let query=`done.php?pname=${pn}&code=${cc}&qty=${qty}&location=${location}&sf=${unit}&price=${price}&total=${total}&save=yes`;
        ajaxRequest.open('GET',query,true);
        ajaxRequest.send();
        return true;



    }







})