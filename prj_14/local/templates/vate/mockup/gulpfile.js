const { src, dest, parallel, series, watch } = require("gulp");
const del = require("del");
const plumber = require("gulp-plumber");
const errorHandler = require("gulp-plumber-error-handler");
const cached = require("gulp-cached");
const browserSync = require("browser-sync").create();
const pug = require("gulp-pug");
const rupture = require("rupture");
const stylus = require("gulp-stylus");
const stylelint = require("gulp-stylelint");
const stylelintFormatterPretty = require('stylelint-formatter-pretty');
const cache = require("gulp-cached");
const autoprefixer = require("autoprefixer-stylus");
const changed = require("gulp-changed");
const zip = require("gulp-zip")
const dotenv = require("dotenv").config();
const imagemin = require("gulp-imagemin");
const recompress = require("imagemin-jpeg-recompress");
const pngquant = require("imagemin-pngquant");
const webpConv = require("gulp-webp");
const rename = require("gulp-rename");
const svgSymbols = require("gulp-svg-symbols");
const path = require("path");
const concat = require("gulp-concat")
const map = require('gulp-sourcemaps');
const sftp = require('gulp-sftp-up4');
// const babel =  require("gulp-babel")


// Локальный сервер
function bs() {
  browserSync.init({
    reloadOnRestart: true,
    open: false,
    port: 3000,
    server: {
      baseDir: ["./app/resources", "dist"],
      directory: false,
      online: true,
    },
  });
}

// Очистка
function clean() {
  return del("./dist/**", {force: true})
}

// Сборка шаблонов
function templates() {
  return src(["./app/pages/*.pug"])
    .pipe(plumber({ errorHandler: errorHandler("Error in 'templates' task") }))
    // .pipe(cached("pug"))
    .pipe(
      pug({
        basedir: "./app",
        pretty: true,
      })
    )
    .pipe(dest("./dist"))
    .pipe(browserSync.stream());
};

// Сборка стилей
function styles() {
  return src("./app/styles/app.styl")
    .pipe(plumber({ errorHandler: errorHandler("Error in 'styles' task") }))
    .pipe(
      stylus({
        use: [rupture(), autoprefixer({ overrideBrowserslist: ['last 5 years and not dead'], grid: true })],
        "include css": true,
        define: {
          // dev-mode variable for using in stylus
        },
      })
    )
    .pipe(dest("dist/assets/styles"))
    .pipe(browserSync.stream());
}

function lintStyles() {
  return src(["app/**/*.styl", "!app/styles/**"])
    .pipe(cache('stylelint'))
    .pipe(
      stylelint({
        fix: true,
        reporters: [
          {
            formatter: stylelintFormatterPretty,
            console: true,
          }
        ],
        failAfterError: process.argv.indexOf('--stylint-error-fail') >= 0
      })
    )
    .pipe(cache('stylelint'))
    .pipe(dest('app'));
}

// Сборка скриптов
function scripts() {
  return src("./app/{scripts,blocks}/**/*.js")
    .pipe(plumber({ errorHandler: errorHandler("Error in 'scripts' task") }))
    .pipe(concat("common.js"))
    .pipe(map.init())
    // .pipe(
    //   babel({
    //     presets: ["@babel/preset-env"],
    //   })
    // )
    .pipe(dest("dist/assets/scripts"))
    .pipe(browserSync.stream());
}

// Копирование изображений блоков
function copyBlockImages() {
  return src(["./app/blocks/**/images/*"])
    .pipe(changed("dist"))
    .pipe(dest("dist/assets/blocks"))
    .pipe(browserSync.stream());
}

// Копирование ресурсов
function copyResources() {
  return src(["./app/resources/**/*"])
    .pipe(changed("dist"))
    .pipe(dest("dist"))
    .pipe(browserSync.stream());
}

// Архивация
function archive() {
  const archiveName = process.env.ARCHIVE_NAME || "dist.zip";
  return src(["./dist/**/*", `!./dist/${archiveName}`])
    .pipe(zip(archiveName))
    .pipe(dest("dist"));
}

// Оптимизация растовых изображений
function rastrOptimize() {
  return src("./dist/**/*.+(png|jpg|jpeg|gif|svg|ico)")
    .pipe(
      imagemin(
        {
          interlaced: true,
          progressive: true,
          optimizationLevel: 5,
        },
        [
          recompress({
            loops: 6,
            min: 50,
            max: 90,
            quality: "high",
            use: [
              pngquant({
                quality: [0.8, 1],
                strip: true,
                speed: 1,
              }),
            ],
          }),
          imagemin.gifsicle(),
          imagemin.optipng(),
          imagemin.svgo(),
        ]
      )
    )
    .pipe(dest("dist"))
}

// Конвертация webpp
function webp() {
  return src("app/**/*.+(png|jpg|jpeg)")
    .pipe(plumber())
    .pipe(webpConv())
    .pipe(dest("app"));
}

// SVG иконки
function icons() {
  return src(["app/icons/**/*.svg", "app/blocks/**/icons/**/*.svg"])
    .pipe(plumber({ errorHandler: errorHandler("Error in 'icons' task") }))
    .pipe(
      svgSymbols({
        title: false,
        id: "icon_%f",
        class: "%f",
        templates: [
          "default-svg",
        ],
      })
    )
    .pipe(rename("icon.svg"))
    .pipe(dest("dist/assets/images/"))
    .pipe(browserSync.stream());
}

// Отслеживание изменений
function watchFiles() {
  watch(
    [
      "./app/{styles,blocks}/**/*.styl",
      "!./app/styles/helpers/variables.styl",
      "!./app/styles/helpers/mixins.styl",
      "!./app/styles/helpers/fonts.styl",
      "!./app/styles/helpers/typography.styl",
    ],
    series(
      styles,
      lintStyles
    )
  ).on("change", (path, stats) => {
    console.log(`File ${path} was changed`);
  });

  watch(["./app/{pages,layouts,include,blocks}/**/*.pug"], templates).on(
    "change",
    (path, stats) => {
      console.log(`File ${path} was changed`);
    }
  );

  watch(["./app/{scripts,blocks}/**/*.js"], scripts).on(
    "change",
    (path, stats) => {
      console.log(`File ${path} was changed`);
    }
  );

  watch(["./app/blocks/**/images/*"], copyBlockImages).on(
    "change",
    (path, stats) => {
      console.log(`File ${path} was changed`);
    }
  );

  watch(["./app/resources/**/*"], copyResources).on(
    "change",
    (path, stats) => {
      console.log(`File ${path} was changed`);
    }
  );

  watch(
    ["app/icons/**/*.svg", "app/blocks/**/icons/**/*.svg"],
    icons
  ).on("change", (path, stats) => {
    console.log(`File ${path} was changed`);
  });

  // watcher.on("add", function (path, stats) {
  //   console.log(`File ${path} was added`);
  // });

  // watcher.on("unlink", function (path, stats) {
  //   console.log(`File ${path} was removed`);
  // });
}

function upload () {
  return src(path.join(process.env.DIST_SRC || './dist', '**'), {base: 'dist'})
    .pipe(sftp({
      host:  process.env.FTP_HOST || '127.0.0.1',
      user:  process.env.FTP_USER || 'root',
      pass:  process.env.FTP_PASS || '',
      port:  process.env.FTP_PORT || 22,
      remotePath:  process.env.FTP_DEST || './project'
    }));
};

let resourceCopyTasks = [],
  imageOptimizeTasks = [],
  uploadTasks = [];

if (process.argv.indexOf('--no-resource-copy') < 0 && process.argv.indexOf('-R') < 0) {
  resourceCopyTasks = [copyBlockImages, copyResources];
}

if (process.argv.indexOf('--no-image-optimize') < 0 && process.argv.indexOf('-I') < 0) {
  imageOptimizeTasks = [rastrOptimize, webp];
}

if (process.argv.indexOf('--upload') >= 0 || process.argv.indexOf('-U') >= 0) {
  uploadTasks = [upload];
}

exports.bs = bs;
exports.clean = clean;
exports.templates = templates;
exports.styles = styles;
exports.lintStyles = lintStyles;
exports.scripts = scripts;
exports.copyBlockImages = copyBlockImages;
exports.copyResources = copyResources;
exports.archive = archive;
exports.rastrOptimize = rastrOptimize;
exports.webp = webp;
exports.icons = icons;
exports.upload = upload;

// Дефолтный таск
exports.default = series(
  clean,
  copyBlockImages,
  copyResources,
  icons,
  parallel(templates, styles, lintStyles, scripts),
  parallel(bs, watchFiles)
);

exports.build = series(
  clean,
  ...resourceCopyTasks,
  ...imageOptimizeTasks,
  icons,
  templates,
  styles,
  scripts,
  archive,
  ...uploadTasks
);

