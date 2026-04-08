import csv
import os
import sys

# ============================================================
# Installation automatique de 'rich' si absent
# ============================================================
try:
    from rich.console import Console
    from rich.table import Table
    from rich import box
except ImportError:
    import subprocess
    subprocess.check_call([sys.executable, "-m", "pip", "install", "rich", "-q"])
    from rich.console import Console
    from rich.table import Table
    from rich import box

# ============================================================
# CONFIGURATION
# ============================================================
INPUT_CSV  = os.path.join(os.path.dirname(os.path.abspath(__file__)), "jobs_wuzzuf_clean.csv")
OUTPUT_CSV = os.path.join(os.path.dirname(os.path.abspath(__file__)), "jobs_wuzzuf_tableau.csv")

console = Console()

# ============================================================
# CHARGEMENT
# ============================================================
if not os.path.exists(INPUT_CSV):
    console.print(f"[bold red]Fichier introuvable :[/] {INPUT_CSV}")
    sys.exit(1)

with open(INPUT_CSV, encoding="utf-8-sig") as f:
    jobs = list(csv.DictReader(f))

console.print(f"\n[bold cyan]Chargement de {len(jobs)} offres...[/]\n")

# ============================================================
# AFFICHAGE TERMINAL
# ============================================================
table = Table(
    title=f"[bold cyan]Wuzzuf -- {len(jobs)} offres Python[/]",
    box=box.ROUNDED,
    border_style="bright_black",
    header_style="bold bright_cyan on grey15",
    show_lines=True,
    padding=(0, 1),
)

table.add_column("Job ID",       style="dim",          min_width=8)
table.add_column("Titre",        style="bold white",   min_width=30)
table.add_column("Societe",      style="yellow",       min_width=20)
table.add_column("Lieu",         style="dim white",    min_width=18)
table.add_column("Contrat",      style="green",        min_width=14)
table.add_column("Mode",         style="bright_green", min_width=10)
table.add_column("Niveau",       style="cyan",         min_width=12)
table.add_column("Experience",   style="cyan",         min_width=16)
table.add_column("Skills",       style="bright_cyan",  min_width=40, overflow="fold")
table.add_column("Date Pub.",    style="dim",          min_width=12)
table.add_column("Expire",       style="white",        min_width=8)
table.add_column("Source",       style="dim",          min_width=8)
table.add_column("Lien",         style="bright_blue",  min_width=50, overflow="fold")

for job in jobs:
    exp = job.get("Expire", "N/A")
    table.add_row(
        job.get("Job_ID",            "N/A"),
        job.get("Titre",             "N/A"),
        job.get("Societe",           "N/A"),
        job.get("Lieu",              "N/A"),
        job.get("Type_Contrat",      "N/A"),
        job.get("Mode_Travail",      "N/A"),
        job.get("Niveau_Experience", "N/A"),
        job.get("Annees_Experience", "N/A"),
        job.get("Skills",            "N/A"),
        job.get("Date_Publication",  "N/A"),
        "Non" if exp == "No" else ("Oui" if exp == "Yes" else exp),
        job.get("Source",            "N/A"),
        job.get("Lien",              "N/A"),
    )

console.print(table)

# ============================================================
# EXPORT CSV AUTOMATIQUE
# ============================================================
EXPORT_FIELDS = [
    "Job_ID", "Titre", "Societe", "Lieu",
    "Type_Contrat", "Mode_Travail", "Niveau_Experience", "Annees_Experience",
    "Skills", "Categories", "Salaire", "Description",
    "Date_Publication", "Date_Relative", "Expire", "Source", "Lien",
]

with open(OUTPUT_CSV, "w", newline="", encoding="utf-8-sig") as f:
    writer = csv.DictWriter(f, fieldnames=EXPORT_FIELDS, extrasaction="ignore")
    writer.writeheader()
    writer.writerows(jobs)

console.print(f"\n[bold green]CSV exporte :[/] [underline]{OUTPUT_CSV}[/]")
console.print(f"[dim]{len(jobs)} lignes x {len(EXPORT_FIELDS)} colonnes[/]\n")