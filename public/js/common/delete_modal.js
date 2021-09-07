'use strict';
function deletModalInput(target)
{
    let input = document.getElementById('deleteInputElement');
    input.value = target.value;
    console.log(input.value);
}
