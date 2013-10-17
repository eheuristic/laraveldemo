@if(Sentry::check())
   @if(Session::has('msg'))
    <div class="alert alert-info">
        {{ Session::get('msg') }}
    </div>
@endif
            <div class="well">
	<form class="form-horizontal" action="{{ URL::to('/sendmail') }}" method="post">
        

        <div class="control-group {{ ($errors->has('email')) ? 'error' : '' }}" for="email">
            <label class="control-label" for="email">To:</label>
            <div class="controls">
                <input name="email" id="email" value="{{ Request::old('email') }}" type="text" class="input-xlarge" placeholder="To">
                {{ ($errors->has('email') ? $errors->first('email') : '') }}
            </div>
        </div>

       <div class="control-group " for="subject">
            <label class="control-label" for="subject">Subject:</label>
            <div class="controls">
                <input name="subject" value="" type="text" class="input-xlarge" placeholder="Subject">
                {{ ($errors->has('subject') ?  $errors->first('subject') : '') }}
            </div>
        </div>

        <div class="control-group" for"content">
            <label class="control-label" for="subject">Content:</label>
                <div class="controls">
                    <textarea class="xxlarge" name="content"></textarea>
                </label>
                </div>
        </div>

        <div class="form-actions">
            <div class="controls">
            <input class="btn btn-primary" type="submit" value="Send">
           </div>
        </div>
  </form>
</div>
    {{ Form::close() }}
@else
    
@endif