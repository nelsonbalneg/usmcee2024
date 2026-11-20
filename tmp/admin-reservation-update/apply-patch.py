from pathlib import Path
import hashlib,json
stage=Path(__file__).resolve().parent
root=Path(r"C:/laragon/www/cee-admin").resolve()
manifest=json.loads((stage/'patch-manifest.json').read_text())
for name, expected in manifest.items():
    target=(root/name).resolve()
    if not target.is_relative_to(root): raise RuntimeError('Invalid target')
    actual=hashlib.sha256(target.read_bytes()).hexdigest() if target.exists() else None
    if actual != expected: raise RuntimeError('Target changed since inspection: '+name)
for name in manifest:
    target=root/name
    if target.exists():
        backup=stage/'originals'/name
        backup.parent.mkdir(parents=True,exist_ok=True)
        backup.write_bytes(target.read_bytes())
    target.parent.mkdir(parents=True,exist_ok=True)
    target.write_bytes((stage/name).read_bytes())
print('Applied',len(manifest),'reviewed files to',root)
