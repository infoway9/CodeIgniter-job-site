// checks that an input string looks like a valid email address.
var isEmail_re      = /^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/;

var isAlnum_re      = /^([a-z0-9])+$/i;

var isChar_re       = /^([a-z])+$/i;

function isEmail (s)
{
    return String(s).search (isEmail_re) != -1;
}

function isAlphaNumeric (s)
{
    return String(s).search (isAlnum_re) != -1;
}

function isCharacter(s)
{
    return String(s).search (isChar_re) != -1;
}
function isInteger(s)
{
    return (s.toString().search(/^[0-9]+$/) == 0);
}
function isFloat(s)
{
    return (s.toString().search(/^\d{1,12}(?:\.\d{0,2})?$/) == 0);
}
// Check if string is non-blank
var isNonblank_re    = /\S/;
function isNonblank (s)
{
    return String (s).search (isNonblank_re) != -1
}

// Check if string is a whole number(digits only).
var isWhole_re       = /^\s*\d+\s*$/;
function isWhole (s)
{
    return String(s).search (isWhole_re) != -1
}

// check 0-9 digit
function regIsDigit(fData)
{
    var reg = new RegExp("^[0-9]$");
    return (reg.test(fData));
}

function keyValid(e, validchars)
{ 
    var key='', keychar='';
    key = getKeyCode(e);
    if(key == null)
        return true;
            
    keychar = String.fromCharCode(key);
    keychar = keychar.toLowerCase();
    validchars = validchars.toLowerCase();
    if (validchars.indexOf(keychar) != -1)
        return true;
    if ( key==null || key==0 || key==8 || key==9 || key==13 || key==27 )
        return true;
    return false;
}


function keyRestrict(e, validchars)
{ 
    var key='', keychar='';
    key = getKeyCode(e);
    if(key == null)
        return true;
    keychar = String.fromCharCode(key);
    keychar = keychar.toLowerCase();
    validchars = validchars.toLowerCase();
    if (validchars.indexOf(keychar) == -1)
        return true;
    if ( key==null || key==0 || key==8 || key==9 || key==13 || key==27 )
        return true;
    return false;
}

function getKeyCode(e)
{
    if(window.event)
        return window.event.keyCode;
    else if(e)
        return e.which;
    else
        return null;
}

function fetch_message(msg_index_string){
    $.post(full_path+"ajax-fetch-message",{
        parameter_string:msg_index_string
    },function(data){
        message_arr=data.split("##@@##");message_index_arr=msg_index_string.split("~");array_length=message_index_arr.length;msg=new Array();for(var x=0;x<array_length;x++){
            msg[message_index_arr[x]]=message_arr[x]
        }
    })
}


function limitChars(element_id, limit, info_div)
{
    var text_content = $('#' + element_id).val();

    var text_content_length = text_content.length;

    if(text_content_length > limit)  {

        $('#' + element_id).val(text_content.substr(0,limit));

        var tot_char_left=0;

    } else {

        var tot_char_left=parseInt(limit) - parseInt(text_content_length);
    }

    var char_count_str = char_count.replace("####", tot_char_left);

    $('#' + info_div).html('('+char_count_str+')');
}


function valid_status(cond,val)
{
    var reg = new RegExp(cond);
    return (reg.test(val));
}
/*
* Function to validate US Postal Code.
*/

function validateUSAZip(zip) 
{
    var reg = new RegExp("^([0-9]{5})(-[0-9]{4})?$");
    return (reg.test(zip));
    //return String(s).search (isZip_re) != -1;
    
}

/*
 *Function to check email is unique....
 */

function unique_email(email1)
{
    var val="Nothing";
    $.ajax({
                type:"POST",
                async: false,
                data:"to_check=email&val="+email1,
                url:full_path+"ajax-check-signup-availability",
                success:function(data){
                    //alert(data);
                    if(data>0)
                        {
                            val='Exists';
                        }
                    else 
                        {
                            val='Notexists';
                        }
                }
    });
    return val;
}

/*
 *Function to check username is unique....
 */

function unique_username(username)
{
    var val="Nothing";
    $.ajax({
                type:"POST",
                async: false,
                data:"to_check=username&val="+username,
                url:full_path+"ajax-check-signup-availability",
                success:function(data){
                    if(data>0)
                        {
                            val='Exists';
                        }
                    else 
                        {
                            val='Notexists';
                        }
                }
    });
    return val;
}

/*
 * Function to check job name is unique .....
 */
function unique_jobname(job_name)
{
    var val="Nothing";
    $.ajax({
                type:"POST",
                async: false,
                data:"to_check=jobname&val="+job_name,
                url:full_path+"ajax-check-job-availability",
                success:function(data){
                    if(data>0)
                        {
                            val='Exists';
                        }
                    else 
                        {
                            val='Notexists';
                        }
                }
    });
    return val;
}

/*
 * URL validation.....  
 */
function validateUrl(validateUrl)
{
    
    var regexp = /^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.)?/; 
    if (!regexp.test(validateUrl)) {        
        return 0;
    } else {        
        return 1;
    }
    
}