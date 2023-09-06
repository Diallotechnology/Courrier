@props(['row'])
@if($row and $row->user)
<div class="d-flex py-1 align-items-center">
    <span class="avatar me-2" @if ($row->user->sexe === "Homme")
        style="background-image: url('/img/h.svg');"
        {{--
        url('https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairDreads01&accessoriesType=Prescription02&hairColor=BrownDark&facialHairType=Blank&clotheType=BlazerSweater&eyeType=Surprised&eyebrowType=Default&mouthType=Twinkle&skinColor=Brown')
        --}}
        @elseif ($row->user->sexe === "Femme")
        style="background-image: url('/img/f.svg');"
        {{-- style="background-image:
        url('https://avataaars.io/?avatarStyle=Transparent&topType=LongHairCurly&accessoriesType=Round&hairColor=Black&facialHairType=Blank&clotheType=ShirtScoopNeck&clotheColor=Blue02&eyeType=Surprised&eyebrowType=Default&mouthType=Default&skinColor=DarkBrown')"
        --}}
        @endif
        >
    </span>
    <div class="flex-fill">
        <div class="font-weight-medium">{{ $row->user->name }}</div>
        <div class="text-muted"><a href="#" class="text-reset">{{ $row->user->email }}</a></div>
    </div>
</div>
@else
inexistant
@endif