@props(['row'])
@if($row)
<div class="d-flex py-1 align-items-center">
    <span class="avatar me-2"
        @if ($row->sexe === "Homme")
        style="background-image: url('https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairDreads01&accessoriesType=Prescription02&hairColor=BrownDark&facialHairType=Blank&clotheType=BlazerSweater&eyeType=Surprised&eyebrowType=Default&mouthType=Twinkle&skinColor=Brown')"
        @elseif ($row->sexe === "Femme")
        style="background-image: url('https://avataaars.io/?avatarStyle=Transparent&topType=LongHairCurly&accessoriesType=Round&hairColor=Black&facialHairType=Blank&clotheType=ShirtScoopNeck&clotheColor=Blue02&eyeType=Surprised&eyebrowType=Default&mouthType=Default&skinColor=DarkBrown')"
        @endif
        {{-- style="background-image: url('https://ui-avatars.com/api/?background=random&bold=true&name={{ $row->user->name }}')" --}}
        ></span>
    <div class="flex-fill">
        <div class="font-weight-medium">{{ $row->name }}</div>
        <div class="text-muted"><p class="text-reset">{{ $row->email }}</p></div>
    </div>
</div>
@else
inexistant
@endif
