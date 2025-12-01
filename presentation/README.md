# Hugo Docs Site

This directory contains the Hugo site for Project 2 documentation and portfolio.

## Configure
- Edit `config.toml` and set `baseURL` to your GitHub Pages URL: `https://<username>.github.io/<repo>/`

## Develop locally
```bash
cd presentation
hugo server -D
```
(Requires Hugo installed locally.)

## Build
```bash
cd presentation
hugo
```
Output will be in `public/`.

## Deploy (GitHub Actions)
- A workflow at `.github/workflows/gh-pages.yml` builds `presentation/` and deploys `presentation/public` to GitHub Pages using `GITHUB_TOKEN`.
- Push to the default branch; Pages will publish automatically. Update `baseURL` and repository name in `config.toml` and the workflow if needed.
