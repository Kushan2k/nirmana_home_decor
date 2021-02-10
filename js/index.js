document.addEventListener('DOMContentLoaded',()=>{
    let forms=document.querySelectorAll('.form');

    

    

    forms.forEach(form=>{
        form.addEventListener('submit',(e)=>{
            let productName=e.target.names.value;
            let colorCode=e.target.code.value?e.target.code.value:'N/A';
            let width=e.target.w.value?e.target.w.value:0;
            let height=e.target.h.value?e.target.h.value:0;
            let controls=e.target.control.value?e.target.control.value:'Not Enterd';
            let peaceId=parseInt(e.target.peaceid.value);
            let additionl=e.target.add.value?(e.target.add.value).trim():'N/A';
            let location=e.target.location.value;

            
            if(senddata(productName,colorCode,width,height,controls,peaceId,additionl,location)){
                alert('Save Successful');
            }else{
                alert('There was a error while saving data')
            }

        });

    });

    
    
});

function senddata(pn,cc='N/A',w,h,co,pid,add='N/A',loc='N/A'){
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
                alert(ajaxRequest.responseText);
                return false;
            }
            
        }

    }
    let query=`save.php?name=${pn}&code=${cc}&width=${w}&height=${h}&control=${co}&peaceid=${pid}&add=${add}&location=${loc}`;
    ajaxRequest.open('GET',query,true);
    ajaxRequest.send();
    return true;



}
