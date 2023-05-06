@props(['header'])

<div class="col-12">
    <div class="card">
        {{ $header }}
        <div {{ $attributes->merge(['class' => 'table-responsive']) }}>
            <table id="datatable" {{ $attributes->merge(['class' => 'table card-table table-vcenter text-nowrap
                datatable']) }}>
                {{ $slot }}
            </table>
        </div>
    </div>
</div>

<script>
    function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("datatable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>