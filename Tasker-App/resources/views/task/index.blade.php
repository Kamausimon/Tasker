 <!DOCTYPE html>
 <html>
 @include('partials._head')

 <body class="bg-gray-700">

     @include('partials._nav')
     <div class="grid grid-cols-5 ">
         @include('partials._sidebar')
         <!-- main content -->
         <div class="col-span-4">
             <h1>Task Dashboard</h1>
         </div>

         <!-- end of main content -->
     </div>

 </body>

 </html>