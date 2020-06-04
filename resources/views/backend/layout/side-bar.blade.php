<div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item ">
        <a class="nav-link {{is_active('admin')}}" href="{{route('admin.home')}}">
          <i class="material-icons">dashboard</i>
          <p>Dashboard</p>
        </a>
      </li>
      <!-- your sidebar here -->
        <li class="nav-item {{is_active('users')}}">
            <a href="{{route('users.index')}}" class="nav-link">
                <i class="material-icons">person</i>
                <p>Users</p>
            </a>
        </li>

        <li class="nav-item {{is_active('categories')}}">
            <a href="{{route('categories.index')}}" class="nav-link">
                <i class="material-icons">bubble_chart</i>
                <p>Categories</p>
            </a>
        </li>

        <li class="nav-item {{is_active('skills')}}">
            <a href="{{route('skills.index')}}" class="nav-link">
                <i class="material-icons">content_paste</i>
                <p>Skills</p>
            </a>
        </li>
        <li class="nav-item {{is_active('tags')}}">
            <a href="{{route('tags.index')}}" class="nav-link">
                <i class="material-icons">content_paste</i>
                <p>Tags</p>
            </a>
        </li>
        <li class="nav-item {{is_active('pages')}}">
            <a href="{{route('pages.index')}}" class="nav-link">
                <i class="material-icons">content_paste</i>
                <p>Pages</p>
            </a>
        </li>
        <li class="nav-item {{is_active('videos')}}">
            <a href="{{route('videos.index')}}" class="nav-link">
                <i class="material-icons">content_paste</i>
                <p>Videos</p>
            </a>
        </li>
        <li class="nav-item {{is_active('messages')}}">
            <a href="{{route('messages.index')}}" class="nav-link">
               
                <p>Messages</p>
            </a>
        </li>
    </ul>
  </div>
