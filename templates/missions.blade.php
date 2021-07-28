@php
    $helper = \Relawanku\Helper::init();
@endphp
<table class="rlw-table" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <td>{{__('No','relawanku')}}</td>
        <td>{{__('Mission Name','relawanku')}}</td>
        <td>{{__('Location','relawanku')}}</td>
        <td>{{__('Period','relawanku')}}</td>
        <td>{{__('Teammates','relawanku')}}</td>
    </tr>
    </thead>
    <tbody>
    @foreach($missions as $mission)
        <tr>
            <td>1</td>
            <td><a href="{{get_edit_post_link($mission->ID)}}">{{$mission->post_title}}</a></td>
            <td>{{$helper->get_post_meta($mission->ID,'location')}}</td>
            <td>
                {{$helper->timestamp_to_date($helper->get_post_meta($mission->ID,'date_start'))}}
            </td>
            <td>
                @php
                    $volunteers = $helper->get_post_meta($mission->ID,'volunteer',false);
                    $volunteers_count = count((array)$volunteers);
                @endphp
                {{sprintf(_n('%s volunteer','%s volunteers',$volunteers_count,'relawanku'),$volunteers_count)}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>