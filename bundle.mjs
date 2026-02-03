import { execSync } from 'child_process';

const fileName = `hasan-miusage`;
const outputFileName = `${fileName}.zip`;
const excludes = `.DS_Store */.DS_Store */*/.DS_Store mix-manifest.json .git .gitattributes .github .editorconfig .gitignore .php-cs-fixer.cache .eslintrc.json .eslintignore gulpfile.js composer.lock node_modules package-lock.json package.json bundle.mjs composer.json webpack.mix.js src yarn.lock bundle.js phpcs.xml *.mjs *.zip ${fileName}`;

const command = `dir-archiver --src . --dest ./${outputFileName} --exclude ${excludes}`;
try {
	execSync(command);
	console.log(`Created zip file: ${outputFileName}`);
} catch (error) {
	console.error('Error creating zip file:', error);
	process.exit(1);
}

