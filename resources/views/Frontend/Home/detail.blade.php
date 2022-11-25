<style>
/* img {
  max-width: 100%;
  height: auto;
} */
.fa {
  padding: 13px;
  /* font-size: 30px; */
  width: 50px;
  text-align: center;
  text-decoration: none;
  margin: 5px 2px;
  border-radius: 5px;
}

.fa:hover {
    opacity: 0.7;
}
.fa-linkedin {
  background: #3B5998;
  color: white;
}
.fa-facebook {
    background: #007bb5;
    color: white !important;
    border-radius:100%;
}
.dot {
  height: 25px;
  width: 25px;
  background-color: yellow;
  border-radius: 50%;
  display: inline-block;
}
.roundImage {
  border-radius: 50%;
  background-color:black;
}
</style>

@extends('Frontend.layouts.main')
@section('main-content')
@if($post_data)
@php 
$device_ip = Helper::getClientIps();

$minutes = 60;
Cookie::queue('device_ip', $device_ip, $minutes);
Cookie::queue('post_id', $post_data->post_id, $minutes);
if(Cookie::get('device_ip') != $device_ip || $post_data->post_id != Cookie::get('post_id')){
isset($post_data)?Helper::updateViewCount($post_data->post_id):'';
}
$link = url('detail/'.$post_data->post_url.'/'.Helper::base64url_encode($post_data->post_id));
@endphp
@section('meta_data')
    <meta property="og:title" content="{{$post_data->title}}"/>
    <meta property="og:image" content="{{url($post_data->img_path)}}" />
    <meta property="og:url" content="{{$link}}" />
    <meta property="og:description" content="{{strip_tags($post_data->description)}}" />
    <meta property="og:site_name" content="{{url('/')}}" />
    <meta name="description" content="{{strip_tags($post_data->description)}}"/>
    <meta name="keywords" content="{{strip_tags($post_data->hashtags)}}"/>
    <meta name="author" content="The Brighter World"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:site_name" content="The Brighter World"/>
    <meta property="og:type" content="article"/>
    <meta property="og:image:width" content="750"/>
    <meta property="og:image:height" content="422"/>
    <meta property="article:published_time" content="{{$post_data->published_date}}"/>
    <meta property="article:modified_time" content="{{$post_data->updated_at}}"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" content="The Brighter World"/>
    <meta name="twitter:creator" content="The Brighter World"/>
    <meta name="twitter:title" content="{{$post_data->title}}"/>
    <meta name="twitter:description" content=""/>
    <meta name="twitter:image" content="{{url($post_data->img_path)}}"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="{{$post_data->title}}">
    <meta name="msapplication-TileImage" content="{{url($post_data->img_path)}}">
@endsection

<section class="carousel_se_01">
    <div class="container-fluid">
        
            
        <div class="row">

       
        <div class="col-md-8">
                <div class="post_header">
                    <div class="post_header_top mt-5">
                        <h2>{{$post_data->title}}</h2>
                        @php 
                            $tags = explode(',', $post_data->hashtags);
                            $count = 0;
                        @endphp
                        <!-- <p>
                            @foreach($tags as $tagrow)
                            @if($count >= 5)
                            @break
                            @endif
                            <a href="{{url('/hashtag/'.urlencode($tagrow))}}" class="tags" >{{$tagrow}}</a>
                            @php $count++ @endphp
                            @endforeach
                        </p> -->
                    </div>
                    <div class="post_header_bottom lead">
            
                        {!! Helper::formatDate($post_data->published_date) !!}&nbsp;&nbsp; |&nbsp;&nbsp; 10:30AM
                        &nbsp;&nbsp;
                        <i class="fa fa-eye lead">{{$post_data->post_view_count}}</i>
                    </div>
                </div>
                <div class="post_body">
                    <div class="post_image">
                            <img src="{{url($post_data->img_path)}}" width="100%;" style="border-radius:10px;" alt="">
                        <p style="overflow-wrap: break-word;margin-top: -25px;  margin-left: 10px;font-size: 10px;color: #aaa;">
						    <a class="text-light" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Image Source</a>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <a href="{{url($post_data->img_source)}}" class="text-primary" target="_blank" >{{url($post_data->img_source)}}</a>
                            </div>
                        </div>

                    </div>

                    <div class="author_detail">
                        <div class="row">
                            <div class="col-6 author_info">
                                <p class="lead mt-3">Author Name-</p>
                            @if(session()->get('user_id'))
                                @if(Helper::getUser()->role == "admin" || Helper::getUser()->role == "moderator")
                                <i class="fa fa-user" ></i> {{$post_data->author?$post_data->author:"N/A"}}
                                @endif
                            @endif
                            </div>
                            <div class="col-6 d-flex flex-row-reverse ">
                                <div class="share_btn">
                                    <p class="lead">Share : 
                                        <a href="#" ><i class="fa fa-linkedin" style="font-size:17px;"></i></a>
                                        <a href="https://www.facebook.com/sharer.php?u={{$link}}" target="_blank" ><i class="fa fa-facebook"></i></a>
                                        
                                        <!-- <a href=""><i class="fa fa-linkedin "></i></a>&nbsp;&nbsp; -->
                                        <a href="http://twitter.com/share?text={{$post_data->title}}&url={{$link}}/&hashtags={{$post_data->hashtags}}" target="_blank"><i class="fa fa-twitter text-info" style="font-size: 30px;"></i></a>
                                        <!-- <a href="https://api.whatsapp.com/send?phone=&text={{urlencode($link)}}" target="_blank"><i class="fa fa-whatsapp text-success" style="font-size: 30px;"></i></a> -->
                                        <a hrref=""><i class="fa fa-envelope" style="font-size: 30px;" aria-hidden="true"></i></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post_description pt-3">
                        <strong>{{ $post_data->synopsis?$post_data->synopsis:'' }}</strong>
                        {!! $post_data->description !!}
                        @php 
                            $tags = explode(',', $post_data->hashtags);
                            $count = 0;
                        @endphp
                        <!-- <p class="text-black">
                            @foreach($tags as $tagrow)
                            @if($count >= 5)
                            @break
                            @endif
                            <a href="{{url('/hashtag/'.urlencode($tagrow))}}" class="tags" >{{$tagrow}}</a>
                            @php $count++ @endphp
                            @endforeach
                        </p> -->
                        <div>
                            <img src=""  alt="Avatar" style="width:20px"><h3><b>Author Name</b></h3>
                        </div>
                    </div>
                </div>
                <div class="post_footer pt-5">
                @if(session()->get('user_id'))
                    @if(Helper::getUser()->role == "admin" || Helper::getUser()->role == "moderator")
                    <div class="more_from_author col-md-10 p-0">
                        <div class="more_from_auhor_header row">
                            <div class="col-12">
                                <div class="row" style="display: contents;">
                                    <!-- <img src="{{url('no_image.png')}}" class="avatar" alt=""> -->
                                    <i class="fa fa-user-circle-o fa-4" style="font-size: 1.5em;padding: 5px;"></i>
                                    <span style="font-weight:700;"> {{$post_data->author?$post_data->author:"N/A"}}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <h2 style="font-weight:700;">More from Author</h2>
                            </div>
                            <div class="col-6 d-flex flex-row-reverse ">
                                <div class="button">
                                    <a href="{!! url('/').'/author/'.$post_data->author.'/'.Helper::base64url_encode($post_data->user_id) !!}" style="color:#fcc80d;">See more</a>
                                </div>
                            </div>
                        </div>
                        
                            
                                @php $fromAuthor = Helper::getPostsByAuthor($post_data->user_id,3) @endphp
                                @foreach($fromAuthor as $author_row)
                                @php $arr = json_decode($author_row->category); @endphp
                                <div class="more_from_author_post">
                                    <a href="{!! url('detail/'.$author_row->post_url.'/'.Helper::base64url_encode($author_row->post_id)) !!}">
                                        <div class="row" style="margin-bottom: 10px">
                                            <div class="col-2">
                                                <img src="{{url($author_row->img_path)}}" width="100%" style="border-radius: 10%;" alt="">
                                            </div>
                                            <div class="col-10">
                                                <div class="post_title">
                                                    {{$author_row->title}}
                                                </div>
                                                <span>{{isset($arr[0])?$arr[0]->category_name:'N/A'}}</span>
                                            </div>
                                            <div class="col-12" style="border-bottom:1px solid rgb(211 208 208);" ></div>
                                        </div>
                                    </a>    
                                </div>
                                @endforeach
                            </div>
                            @endif
                    @endif

                    <div class="comments pt-5">
                        <h3>Comments</h3>
                        <form action="{{url('/comment')}}" method="post">
                            @csrf 
                            <input type="text" name="id" value={{$post_data->post_id}} hidden>
                            <textarea name="comment" class="form-control" id="comment" cols="30" rows="2" placeholder="Add a comment" ></textarea>
                            <div class="comment_form_btn d-flex flex-row-reverse pt-2 pb-2">
                                <div class="submit">
                                    @if(session()->get('user_id'))
                                        <input type="submit" class="btn btn-info" />
                                    @else
                                        <a href="{{url('/login')}}" class="btn btn-warning" >Login</a>
                                    @endif
                                </div>
                            </div>
                        </form>

                        <div class="comment_list">
                            @php $comment = Helper::getComments($post_data->post_id); @endphp
                            
                            @foreach($comment as $c_row)
                            <div class="more_from_author_post">
                                    <div class="row" style="margin-bottom: 10px">
                                        <div class="col-1">
                                            <img src="{{url('no_image.png')}}" width="45px" style="border-radius: 10%;" alt="">
                                        </div>
                                        <div class="col-10">
                                            <div class="post_title">
                                                <strong>{{$c_row->name!=null?$c_row->name:'N/A'}}</strong> &nbsp; {!! Helper::day_ago($c_row->created_at) !!}
                                            </div>
                                            <span>{{$c_row->comment}}</span>
                                        </div>
                                    <div class="col-10" style="border-bottom:1px solid rgb(211 208 208); margin:auto" ></div>
                                </div>
                            </div>
                            @endforeach
                            

                        </div>
                    </div>
                </div>

            </div>
            
            
            <div class="col-md-4 pt-5">
            <div class="related_post col-md-10 p-2">
                        <div class="more_from_auhor_header row">
                            <div class="col-12 text-center">
                                <span class="dot"></span>&nbsp;&nbsp;<b style="font-size:30px;">Related News</b>
                            </div>
                        </div>
                        @php $relatedPost = Helper::getPosts($post_data->category_id,5) @endphp
                        @foreach($relatedPost as $r_row)
                        @php $arr = json_decode($r_row->category); @endphp
                        <div class="more_from_author_post">
                            <a href="{!! url('detail/'.$r_row->post_url.'/'.Helper::base64url_encode($r_row->post_id)) !!}">
                                <div class="row p-3" style="margin-bottom: 10px">
                                    <div class="col-10">
                                        <div class="post_title">
                                            {{$r_row->title}}
                                        </div>
                                        <span>{{isset($arr[0])?$arr[0]->category_name:'N/A'}}</span>
                                    </div>
                                    <div class="col-2">
                                        <img src="{{$r_row->img_path?url($r_row->img_path):url('no_image.png')}}" width="45px" style="border-radius: 10%;" alt="">
                                    </div>
                                    <div class="col-10" style="border-bottom:1px solid rgb(211 208 208); margin:auto" ></div>
                                </div>
                            </a>
                                
                        </div>
                        @endforeach
                    </div>
            </div>
        </div>
    </div>
</section>
@else
Post not found.
<a href="{{url('/')}}">Go To Home</a>
@endif
@endsection
