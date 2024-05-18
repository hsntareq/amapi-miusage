import { execSync } from 'child_process';

const outputFileName = `hasan-miusage-dev.zip`;
const excludes = `.DS_Store */.DS_Store */*/.DS_Store node_modules vendor *.zip`;

const command = `dir-archiver --src . --dest ./${outputFileName} --exclude ${excludes}`;
try {
	execSync(command);
	console.log(`Created zip file: ${outputFileName}`);
} catch (error) {
	console.error('Error creating zip file:', error);
	process.exit(1);
}

