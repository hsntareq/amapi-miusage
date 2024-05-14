import { defineConfig } from "vite";
// vite.config.js
export default defineConfig({
	server: {
		port: 3030,
	},
	build: {
		manifest: true,
		assetsDir: './img',
		outDir: 'assets/dist',
		optimizeDeps: {
			include: [
				'assets/src/admin.js',
				'assets/src/front.js'
			],
		},
		rollupOptions: {
			input: {
				'admin': '/assets/src/admin.js',
				'front': '/assets/src/front.js',
			},
			output: {
				entryFileNames: '[name].js',
				assetFileNames: '[name][extname]',
				chunkFileNames: '[name].min.[extname]',
			},
			refresh: true,
		},
	},

})
