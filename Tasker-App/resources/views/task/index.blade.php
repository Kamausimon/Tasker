 <!DOCTYPE html>
 <html>
 @include('partials._head')

 <body class="bg-gray-700">

     @include('partials._nav')
     <div class="grid grid-cols-6 gap-0">
         <div clas="col-span-1">
             @include('partials._sidebar')
         </div>

         <!-- main content -->
         <div class="col-span-5">
             <div>
                 <!-- min nav -->
                 <div>
                     @include('partials._minNav')
                 </div>
                 <!-- end of min nav -->
                 <!-- main content layout -->
                 <div>
                     @yield('content')
                 </div>
                 <!-- main content layout end -->
             </div>
         </div>

         <!-- end of main content -->
     </div>

 </body>

 </html>