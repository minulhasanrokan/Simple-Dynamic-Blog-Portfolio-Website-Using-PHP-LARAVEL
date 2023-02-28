@php
    $contact_details_data = App\Models\User::find(1);

    $social_media = $contact_details_data->social_media;

    $social_media_arr = explode("***",$social_media);


@endphp

<div class="widget">
    <h5 class="title">Contact Information</h5>
    <ul class="sidebar__contact__info">
        <li>{!!$contact_details_data->address!!}</li>
        <li><a href="mailto:{!!$contact_details_data->email!!}">{!!$contact_details_data->email!!}</a></li>
        <li><a href="tel:{!!$contact_details_data->mobile!!}">{!!$contact_details_data->mobile!!}</a></li>
    </ul>
    <ul class="sidebar__contact__social">
        @if(count($social_media_arr)>0)
            @foreach($social_media_arr as $data_arr)
                @php

                    $data = explode("___",$data_arr);

                    $social='';
                    $icon='';

                    if(isset($data[1])){

                        $social = $data[1];
                        $icon = $data[0];
                    }

                @endphp
                <li><a target="_blank" href="http://{{$social}}"><i class="fab fa-{{$icon}}"></i></a></li>

            @endforeach
        @endif
    </ul>
</div>