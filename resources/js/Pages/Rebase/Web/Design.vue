<script>
import Layout from "@/Templates/Rebase/WorkspaceMain"

export default {
   layout: Layout,
   metaInfo: { title: "Design Concepts" },
   data: () => ({
      form: {
         id: 1,
         name: "",
         email: "",
         checkbox: [],
         checkbox2: [],
      },
   }),
}
</script>

<template>
   <section class="design-page">
      <h1>Grid</h1>
      <p>This is the 12 column grid, by default, there is a gap of 16 pixels between each column and on the top/bottom of each row. There is no row gap on the bottom of the last grid, or the top of the first one</p>
      <p>Also, by default, there is no wrapping.</p>
      <hr />
      <div class="grid">
         <div class="col col-1">1</div>
         <div class="col col-1">2</div>
         <div class="col col-1">3</div>
         <div class="col col-1">4</div>
         <div class="col col-1">5</div>
         <div class="col col-1">6</div>
         <div class="col col-1">7</div>
         <div class="col col-1">8</div>
         <div class="col col-1">9</div>
         <div class="col col-1">10</div>
         <div class="col col-1">11</div>
         <div class="col col-1">12</div>
      </div>
      <h2>Cols can mix-and-match</h2>
      <hr />
      <div class="grid">
         <div class="col col-1">1</div>
         <div class="col col-11">11</div>
      </div>
      <div class="grid">
         <div class="col col-2">2</div>
         <div class="col col-10">10</div>
      </div>
      <div class="grid">
         <div class="col col-3">3</div>
         <div class="col col-9">9</div>
      </div>
      <div class="grid">
         <div class="col col-4">4</div>
         <div class="col col-8">8</div>
      </div>
      <div class="grid">
         <div class="col col-5">5</div>
         <div class="col col-7">7</div>
      </div>
      <div class="grid">
         <div class="col col-6">6</div>
         <div class="col col-6">6</div>
      </div>
      <h2>Centering Columns</h2>
      <hr />
      <div class="grid">
         <div class="col col-12">12 cols centered</div>
      </div>
      <div class="grid">
         <div class="col col-10--centered">10 cols centered</div>
      </div>
      <div class="grid">
         <div class="col col-8--centered">8 cols centered</div>
      </div>
      <div class="grid">
         <div class="col col-6--centered">6 cols centered</div>
      </div>
      <div class="grid">
         <div class="col col-4--centered">4 cols centered</div>
      </div>
      <div class="grid">
         <div class="col col-2--centered">2 cols centered</div>
      </div>

      <h1>Colors</h1>
      <p>These are all the default colors</p>

      <div class="grid">
         <div class="col-2">
            <h3>Rose</h3>
            <ul class="swatch">
               <li class="color-rose-50"></li>
               <li class="color-rose-100"></li>
               <li class="color-rose-200"></li>
               <li class="color-rose-300"></li>
               <li class="color-rose-400"></li>
               <li class="color-rose-500"></li>
               <li class="color-rose-600"></li>
               <li class="color-rose-700"></li>
               <li class="color-rose-800"></li>
               <li class="color-rose-900"></li>
            </ul>
         </div>
         <div class="col-2">
            <h3>Pink</h3>
            <ul class="swatch">
               <li class="color-pink-50"></li>
               <li class="color-pink-100"></li>
               <li class="color-pink-200"></li>
               <li class="color-pink-300"></li>
               <li class="color-pink-400"></li>
               <li class="color-pink-500"></li>
               <li class="color-pink-600"></li>
               <li class="color-pink-700"></li>
               <li class="color-pink-800"></li>
               <li class="color-pink-900"></li>
            </ul>
         </div>
         <div class="col-2">
            <h3>Fuchsia</h3>
            <ul class="swatch">
               <li class="color-fuchsia-50"></li>
               <li class="color-fuchsia-100"></li>
               <li class="color-fuchsia-200"></li>
               <li class="color-fuchsia-300"></li>
               <li class="color-fuchsia-400"></li>
               <li class="color-fuchsia-500"></li>
               <li class="color-fuchsia-600"></li>
               <li class="color-fuchsia-700"></li>
               <li class="color-fuchsia-800"></li>
               <li class="color-fuchsia-900"></li>
            </ul>
         </div>
         <div class="col-2">
            <h3>Purple</h3>
            <ul class="swatch">
               <li class="color-purple-50"></li>
               <li class="color-purple-100"></li>
               <li class="color-purple-200"></li>
               <li class="color-purple-300"></li>
               <li class="color-purple-400"></li>
               <li class="color-purple-500"></li>
               <li class="color-purple-600"></li>
               <li class="color-purple-700"></li>
               <li class="color-purple-800"></li>
               <li class="color-purple-900"></li>
            </ul>
         </div>
         <div class="col-2">
            <h3>Violet</h3>
            <ul class="swatch">
               <li class="color-violet-50"></li>
               <li class="color-violet-100"></li>
               <li class="color-violet-200"></li>
               <li class="color-violet-300"></li>
               <li class="color-violet-400"></li>
               <li class="color-violet-500"></li>
               <li class="color-violet-600"></li>
               <li class="color-violet-700"></li>
               <li class="color-violet-800"></li>
               <li class="color-violet-900"></li>
            </ul>
         </div>
         <div class="col-2">
            <h3>Indigo</h3>
            <ul class="swatch">
               <li class="color-indigo-50"></li>
               <li class="color-indigo-100"></li>
               <li class="color-indigo-200"></li>
               <li class="color-indigo-300"></li>
               <li class="color-indigo-400"></li>
               <li class="color-indigo-500"></li>
               <li class="color-indigo-600"></li>
               <li class="color-indigo-700"></li>
               <li class="color-indigo-800"></li>
               <li class="color-indigo-900"></li>
            </ul>
         </div>
      </div>
      <div class="grid">
         <div class="col-2">
            <h3>Blue</h3>
            <ul class="swatch">
               <li class="color-blue-50"></li>
               <li class="color-blue-100"></li>
               <li class="color-blue-200"></li>
               <li class="color-blue-300"></li>
               <li class="color-blue-400"></li>
               <li class="color-blue-500"></li>
               <li class="color-blue-600"></li>
               <li class="color-blue-700"></li>
               <li class="color-blue-800"></li>
               <li class="color-blue-900"></li>
            </ul>
         </div>
         <div class="col-2">
            <h3>Light Blue</h3>
            <ul class="swatch">
               <li class="color-lightBlue-50"></li>
               <li class="color-lightBlue-100"></li>
               <li class="color-lightBlue-200"></li>
               <li class="color-lightBlue-300"></li>
               <li class="color-lightBlue-400"></li>
               <li class="color-lightBlue-500"></li>
               <li class="color-lightBlue-600"></li>
               <li class="color-lightBlue-700"></li>
               <li class="color-lightBlue-800"></li>
               <li class="color-lightBlue-900"></li>
            </ul>
         </div>
         <div class="col-2">
            <h3>Cyan</h3>
            <ul class="swatch">
               <li class="color-cyan-50"></li>
               <li class="color-cyan-100"></li>
               <li class="color-cyan-200"></li>
               <li class="color-cyan-300"></li>
               <li class="color-cyan-400"></li>
               <li class="color-cyan-500"></li>
               <li class="color-cyan-600"></li>
               <li class="color-cyan-700"></li>
               <li class="color-cyan-800"></li>
               <li class="color-cyan-900"></li>
            </ul>
         </div>
         <div class="col-2">
            <h3>Teal</h3>
            <ul class="swatch">
               <li class="color-teal-50"></li>
               <li class="color-teal-100"></li>
               <li class="color-teal-200"></li>
               <li class="color-teal-300"></li>
               <li class="color-teal-400"></li>
               <li class="color-teal-500"></li>
               <li class="color-teal-600"></li>
               <li class="color-teal-700"></li>
               <li class="color-teal-800"></li>
               <li class="color-teal-900"></li>
            </ul>
         </div>
         <div class="col-2">
            <h3>Emerald</h3>
            <ul class="swatch">
               <li class="color-emerald-50"></li>
               <li class="color-emerald-100"></li>
               <li class="color-emerald-200"></li>
               <li class="color-emerald-300"></li>
               <li class="color-emerald-400"></li>
               <li class="color-emerald-500"></li>
               <li class="color-emerald-600"></li>
               <li class="color-emerald-700"></li>
               <li class="color-emerald-800"></li>
               <li class="color-emerald-900"></li>
            </ul>
         </div>
         <div class="col-2">
            <h3>Green</h3>
            <ul class="swatch">
               <li class="color-green-50"></li>
               <li class="color-green-100"></li>
               <li class="color-green-200"></li>
               <li class="color-green-300"></li>
               <li class="color-green-400"></li>
               <li class="color-green-500"></li>
               <li class="color-green-600"></li>
               <li class="color-green-700"></li>
               <li class="color-green-800"></li>
               <li class="color-green-900"></li>
            </ul>
         </div>
      </div>
      <div class="grid">
         <div class="col-2">
            <h3>Lime</h3>
            <ul class="swatch">
               <li class="color-lime-50"></li>
               <li class="color-lime-100"></li>
               <li class="color-lime-200"></li>
               <li class="color-lime-300"></li>
               <li class="color-lime-400"></li>
               <li class="color-lime-500"></li>
               <li class="color-lime-600"></li>
               <li class="color-lime-700"></li>
               <li class="color-lime-800"></li>
               <li class="color-lime-900"></li>
            </ul>
         </div>
         <div class="col-2">
            <h3>Yellow</h3>
            <ul class="swatch">
               <li class="color-yellow-50"></li>
               <li class="color-yellow-100"></li>
               <li class="color-yellow-200"></li>
               <li class="color-yellow-300"></li>
               <li class="color-yellow-400"></li>
               <li class="color-yellow-500"></li>
               <li class="color-yellow-600"></li>
               <li class="color-yellow-700"></li>
               <li class="color-yellow-800"></li>
               <li class="color-yellow-900"></li>
            </ul>
         </div>
         <div class="col-2">
            <h3>Amber</h3>
            <ul class="swatch">
               <li class="color-amber-50"></li>
               <li class="color-amber-100"></li>
               <li class="color-amber-200"></li>
               <li class="color-amber-300"></li>
               <li class="color-amber-400"></li>
               <li class="color-amber-500"></li>
               <li class="color-amber-600"></li>
               <li class="color-amber-700"></li>
               <li class="color-amber-800"></li>
               <li class="color-amber-900"></li>
            </ul>
         </div>
         <div class="col-2">
            <h3>Orange</h3>
            <ul class="swatch">
               <li class="color-orange-50"></li>
               <li class="color-orange-100"></li>
               <li class="color-orange-200"></li>
               <li class="color-orange-300"></li>
               <li class="color-orange-400"></li>
               <li class="color-orange-500"></li>
               <li class="color-orange-600"></li>
               <li class="color-orange-700"></li>
               <li class="color-orange-800"></li>
               <li class="color-orange-900"></li>
            </ul>
         </div>
         <div class="col-2">
            <h3>Red</h3>
            <ul class="swatch">
               <li class="color-red-50"></li>
               <li class="color-red-100"></li>
               <li class="color-red-200"></li>
               <li class="color-red-300"></li>
               <li class="color-red-400"></li>
               <li class="color-red-500"></li>
               <li class="color-red-600"></li>
               <li class="color-red-700"></li>
               <li class="color-red-800"></li>
               <li class="color-red-900"></li>
            </ul>
         </div>
         <div class="col-2">
            <h3>Warm Gray</h3>
            <ul class="swatch">
               <li class="color-warmGray-50"></li>
               <li class="color-warmGray-100"></li>
               <li class="color-warmGray-200"></li>
               <li class="color-warmGray-300"></li>
               <li class="color-warmGray-400"></li>
               <li class="color-warmGray-500"></li>
               <li class="color-warmGray-600"></li>
               <li class="color-warmGray-700"></li>
               <li class="color-warmGray-800"></li>
               <li class="color-warmGray-900"></li>
            </ul>
         </div>
      </div>
      <div class="grid">
         <div class="col-2">
            <h3>True Gray</h3>
            <ul class="swatch">
               <li class="color-trueGray-50"></li>
               <li class="color-trueGray-100"></li>
               <li class="color-trueGray-200"></li>
               <li class="color-trueGray-300"></li>
               <li class="color-trueGray-400"></li>
               <li class="color-trueGray-500"></li>
               <li class="color-trueGray-600"></li>
               <li class="color-trueGray-700"></li>
               <li class="color-trueGray-800"></li>
               <li class="color-trueGray-900"></li>
            </ul>
         </div>
         <div class="col-2">
            <h3>Gray</h3>
            <ul class="swatch">
               <li class="color-gray-50"></li>
               <li class="color-gray-100"></li>
               <li class="color-gray-200"></li>
               <li class="color-gray-300"></li>
               <li class="color-gray-400"></li>
               <li class="color-gray-500"></li>
               <li class="color-gray-600"></li>
               <li class="color-gray-700"></li>
               <li class="color-gray-800"></li>
               <li class="color-gray-900"></li>
            </ul>
         </div>
         <div class="col-2">
            <h3>Cool Gray</h3>
            <ul class="swatch">
               <li class="color-coolGray-50"></li>
               <li class="color-coolGray-100"></li>
               <li class="color-coolGray-200"></li>
               <li class="color-coolGray-300"></li>
               <li class="color-coolGray-400"></li>
               <li class="color-coolGray-500"></li>
               <li class="color-coolGray-600"></li>
               <li class="color-coolGray-700"></li>
               <li class="color-coolGray-800"></li>
               <li class="color-coolGray-900"></li>
            </ul>
         </div>
         <div class="col-2">
            <h3>Blue Gray</h3>
            <ul class="swatch">
               <li class="color-blueGray-50"></li>
               <li class="color-blueGray-100"></li>
               <li class="color-blueGray-200"></li>
               <li class="color-blueGray-300"></li>
               <li class="color-blueGray-400"></li>
               <li class="color-blueGray-500"></li>
               <li class="color-blueGray-600"></li>
               <li class="color-blueGray-700"></li>
               <li class="color-blueGray-800"></li>
               <li class="color-blueGray-900"></li>
            </ul>
         </div>
      </div>
      <h1>Padding and Margin</h1>
      <div class="grid">
         <div class="col-4">
            <div class="block height-4"></div>
         </div>
         <div class="col-8">
            <div class="font-4">4px Size</div>
         </div>
      </div>
      <div class="grid">
         <div class="col-4">
            <div class="block height-8"></div>
         </div>
         <div class="col-8">
            <div class="font-8">8px Size</div>
         </div>
      </div>
      <div class="grid">
         <div class="col-4">
            <div class="block height-12"></div>
         </div>
         <div class="col-8">
            <div class="font-12">12px Size</div>
         </div>
      </div>
      <div class="grid">
         <div class="col-4">
            <div class="block height-14"></div>
         </div>
         <div class="col-8">
            <div class="font-14">14px Size</div>
         </div>
      </div>
      <div class="grid">
         <div class="col-4">
            <div class="block height-16"></div>
         </div>
         <div class="col-8">
            <div class="font-16">16px Size</div>
         </div>
      </div>
      <div class="grid">
         <div class="col-4">
            <div class="block height-18"></div>
         </div>
         <div class="col-8">
            <div class="font-18">18px Size</div>
         </div>
      </div>
      <div class="grid">
         <div class="col-4">
            <div class="block height-20"></div>
         </div>
         <div class="col-8">
            <div class="font-20">20px Size</div>
         </div>
      </div>
      <div class="grid">
         <div class="col-4">
            <div class="block height-24"></div>
         </div>
         <div class="col-8">
            <div class="font-24">24px Size</div>
         </div>
      </div>
      <div class="grid">
         <div class="col-4">
            <div class="block height-30"></div>
         </div>
         <div class="col-8">
            <div class="font-30">30px Size</div>
         </div>
      </div>
      <div class="grid">
         <div class="col-4">
            <div class="block height-32"></div>
         </div>
         <div class="col-8">
            <div class="font-32">32px Size</div>
         </div>
      </div>
      <div class="grid">
         <div class="col-4">
            <div class="block height-36"></div>
         </div>
         <div class="col-8">
            <div class="font-36">36px Size</div>
         </div>
      </div>
      <div class="grid">
         <div class="col-4">
            <div class="block height-40"></div>
         </div>
         <div class="col-8">
            <div class="font-40">40px Size</div>
         </div>
      </div>
      <div class="grid">
         <div class="col-4">
            <div class="block height-48"></div>
         </div>
         <div class="col-8">
            <div class="font-48">48px Size</div>
         </div>
      </div>
      <div class="grid">
         <div class="col-4">
            <div class="block height-60"></div>
         </div>
         <div class="col-8">
            <div class="font-60">60px Size</div>
         </div>
      </div>
      <div class="grid">
         <div class="col-4">
            <div class="block height-64"></div>
         </div>
         <div class="col-8">
            <div class="font-64">64px Size</div>
         </div>
      </div>
      <div class="grid">
         <div class="col-4">
            <div class="block height-72"></div>
         </div>
         <div class="col-8">
            <div class="font-72">72px Size</div>
         </div>
      </div>
      <div class="grid">
         <div class="col-4">
            <div class="block height-80"></div>
         </div>
         <div class="col-8">
            <div class="font-80">80px Size</div>
         </div>
      </div>
      <div class="grid">
         <div class="col-4">
            <div class="block height-96"></div>
         </div>
         <div class="col-8">
            <div class="font-96">96px Size</div>
         </div>
      </div>
      <div class="grid">
         <div class="col-4">
            <div class="block height-128"></div>
         </div>
         <div class="col-8">
            <div class="font-128">128px Size</div>
         </div>
      </div>
      <div class="grid">
         <div class="col-4">
            <div class="block height-160"></div>
         </div>
         <div class="col-8">
            <div class="font-160">160px Size</div>
         </div>
      </div>
      <div class="grid">
         <div class="col-4">
            <div class="block height-192"></div>
         </div>
         <div class="col-8">
            <div class="font-192">192px Size</div>
         </div>
      </div>
      <div class="grid">
         <div class="col-4">
            <div class="block height-224"></div>
         </div>
         <div class="col-8">
            <div class="font-224">224px Size</div>
         </div>
      </div>
      <div class="grid">
         <div class="col-4">
            <div class="block height-256"></div>
         </div>
         <div class="col-8">
            <div class="font-256">256px Size</div>
         </div>
      </div>
   </section>
</template>

<style lang="scss" scoped>
@import "@@/abstract";

.design-page {
   margin: 0 auto;
   width: 90vw;
}
.col {
   background: rgba(#f00, 0.2);
   border: 1px solid rgba(#f00, 0.5);
   justify-content: center;
}

.block {
   background: $color-red-200;
   width: 100%;
}

.swatch {
   padding: 0;
   margin: 0;
   width: 100%;
   list-style-type: none;

   li {
      width: 100%;
      display: block;
      height: 50px;
   }
}
$sizes: 50, 100, 200, 300, 400, 500, 600, 700, 800, 900;
$names: "rose", "pink", "fuchsia", "purple", "violet", "indigo", "blue", "lightBlue", "cyan", "teal", "emerald", "green", "lime", "yellow", "amber", "orange", "red", "warmGray", "trueGray", "gray", "coolGray", "blueGray";

@each $name in $names {
   @each $size in $sizes {
      .color-#{$name}-#{$size} {
         $s: "color-#{$name}-#{$size}";
         background: map-get($colors, $s);
      }
   }
}

$spacing: 0, 4, 8, 12, 14, 16, 18, 20, 24, 30, 32, 36, 40, 48, 60, 64, 72, 80, 96, 128, 160, 192, 224, 256;

@each $space in $spacing {
   .height-#{$space} {
      height: rem($space * 1px);
   }

   .font-#{$space} {
      font-size: rem($space * 1px);
   }
}
</style>
