function updateSearchBox()
{
    var query = document.getElementById('inputlg');
    var dropdown = document.getElementById('dropdown-search');

    var div = document.createElement('div');
    div.className = 'suggestion';
    div.innerHTML = "<p>" + query.value + "</p>";
    dropdown.appendChild(div);
}