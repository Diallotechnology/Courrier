@props(['row'])
@if($row)
<div class="d-flex py-1 align-items-center">
    <span class="avatar me-2"
        style="background-image: url('https://ui-avatars.com/api/?background=random&bold=true&name={{ $row->user->name }}')"></span>
    <div class="flex-fill">
        <div class="font-weight-medium">{{ $row->user->name }}</div>
        <div class="text-muted"><a href="#" class="text-reset">{{ $row->user->email }}</a></div>
    </div>
</div>
@endif